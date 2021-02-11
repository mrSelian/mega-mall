<?php

namespace App\Http\Controllers\Shop;


use App\Cart;
use App\CartProduct;
use App\CartRepositoryInterface;
use App\DbOrderService;
use App\Http\Controllers\Controller;
use App\SessionCartRepository;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    private CartRepositoryInterface $cartRepository;

    public function __construct()
    {
        $this->cartRepository = new SessionCartRepository();
    }

    public function index()
    {

        $cart = $this->getCart();

        $totalPrice = $cart->calculateTotalPrice();

        return view('shop.cart', compact('totalPrice'),compact('cart'));
    }


    public function addProduct(Request $request)
    {
        $id = $request->id;

        $amount = $request->amount;

        $productRec = Product::where('id', $id)->firstOrFail();

        $cart = $this->getCart();



        if (!$cart->hasProductWithId($id)) {

            $product = new \App\Product($productRec);

            if (!$product->qtyIsAvailable($amount)) {
                throw new \Exception('Запрашиваемое количество товара больше остатка !');
            }

            $cartProduct = new CartProduct($product, $amount);

            $cart->addToCart($cartProduct);

            $this->cartRepository->save($cart);

            return redirect(route('cart'));
        }
        $cart->correctAmount($id,$cart->hasProductWithId($id)->getAmount()+$amount);

        $this->cartRepository->save($cart);

        return redirect(route('cart'));
    }


    public function removeProduct(Request $request): \Illuminate\Http\RedirectResponse
    {

        $cart = $this->getCart();
        $cart->removeFromCart($request->id);

        $this->cartRepository->save($cart);

        return redirect()->back();
    }

    public function clearCart(): \Illuminate\Http\RedirectResponse
    {
        $cart = $this->getCart();
        $cart->clear();
        $this->cartRepository->save($cart);

        return redirect()->back();
    }

    public function actualize(Request $request): \Illuminate\Http\RedirectResponse
    {
        $cart = $this->getCart();
        $cart->actualize();
        $this->cartRepository->save($cart);
        return redirect()->back();
    }

    public function toOrder()
    {
        $cart = $this->getCart();
        $cart->actualize();
        $cart->toOrder(new DbOrderService());
    }

    public function correctAmount(Request $request)
    {
        $cart = $this->getCart();
        $amount = $request->amount;
        $id = $request->id;
        $cart->correctAmount($id, $amount);
        return redirect()->back();

    }


    private function getCart(): Cart
    {
        return $this->cartRepository->get();
    }

}
