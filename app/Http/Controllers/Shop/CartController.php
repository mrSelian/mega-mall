<?php

namespace App\Http\Controllers\Shop;


use App\DbProductRepository;
use App\Domain\Cart;
use App\Domain\CartProduct;
use App\Domain\CartRepositoryInterface;
use App\DbOrderService;
use App\Domain\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\SessionCartRepository;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    private CartRepositoryInterface $cartRepository;
    private ProductRepositoryInterface $productRepository;

    public function __construct()
    {
        $this->cartRepository = new SessionCartRepository();
        $this->productRepository = new DbProductRepository();
    }

    public function index()
    {

        $cart = $this->getCart();

        $photos = [];
        foreach ($cart->getProducts() as $product)
        {
           $photos[$product->getId()] = $this->productRepository->getPhoto($product->getId());
        }

        return view('shop.cart',compact('cart'), compact('photos'));
    }


    public function addProduct(Request $request)
    {
        $id = $request->id;

        $amount = $request->amount;

        $cart = $this->getCart();

        $product = $this->productRepository->getById($id);

        if (!$cart->hasProductWithId($id)) {

            if (!$product->qtyIsAvailable($amount)) {
                throw new \Exception('Запрашиваемое количество товара больше остатка !');
            }

            $cartProduct = new CartProduct($product->getId(), $product->getName(), $product->getPrice() ,$amount);

            $cart->addToCart($cartProduct);

            $this->cartRepository->save($cart->toArray());

            return redirect(route('cart'));
        }
        $cart->correctAmount($product,$cart->hasProductWithId($id)->getAmount()+$amount);

        $this->cartRepository->save($cart->toArray());

        return redirect(route('cart'));
    }


    public function removeProduct(Request $request): \Illuminate\Http\RedirectResponse
    {

        $cart = $this->getCart();
        $cart->removeFromCart($request->id);

        $this->cartRepository->save($cart->toArray());

        return redirect()->back();
    }

    public function clearCart(): \Illuminate\Http\RedirectResponse
    {
        $cart = $this->getCart();
        $cart->clear();
        $this->cartRepository->save($cart->toArray());

        return redirect()->back();
    }

    public function actualize(): \Illuminate\Http\RedirectResponse
    {
        $cart = $this->getCart();
        $cart->actualize($this->productRepository);
        $this->cartRepository->save($cart->toArray());
        return redirect()->back();
    }

    public function toOrder()
    {
        $cart = $this->getCart();
        $cart->actualize($this->productRepository);
        $cart->toOrder(new DbOrderService());
        return redirect(route('customer_orders'));
    }

    public function correctAmount(Request $request)
    {
        $cart = $this->getCart();
        $amount = $request->amount;
        $id = $request->id;
        $product = $this->productRepository->getById($id);
        $cart->correctAmount($product, $amount);
        $this->cartRepository->save($cart->toArray());
        return redirect()->back();

    }


    private function getCart(): Cart
    {
        return $this->cartRepository->get();
    }

}
