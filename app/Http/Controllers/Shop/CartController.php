<?php

namespace App\Http\Controllers\Shop;


use App\Cart;
use App\CartProduct;
use App\Http\Controllers\Controller;
use App\SessionCartRepository;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index()
    {

        $cart = $this->getCart();

        $totalPrice = $cart->calculateTotalPrice();

        return view('shop.cart', compact('totalPrice'));
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

            return redirect(route('cart'));
        }
        $cart->correctAmount($id,$cart->hasProductWithId($id)->getAmount()+$amount);

        return redirect(route('cart'));
    }


    public function removeProduct(Request $request): \Illuminate\Http\RedirectResponse
    {

        $cart = $this->getCart();
        $cart->removeFromCart($request->id);

        return redirect()->back();
    }

    public function clearCart(): \Illuminate\Http\RedirectResponse
    {
        $cart = $this->getCart();
        $cart->clear();

        return redirect()->back();
    }

    public function actualize(Request $request): \Illuminate\Http\RedirectResponse
    {
        $cart = $this->getCart();
        $cart->actualize();
        return redirect()->back();
    }

    public function toOrder()
    {
        $cart = $this->getCart();
        $cart->actualize();
        $cart->toOrder();
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
        $repository = new SessionCartRepository();
        return $repository->get();
    }

}
