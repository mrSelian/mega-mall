<?php

namespace App\Http\Controllers;


use App\Cart;
use App\CartProduct;
use App\CartRepository;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index(Request $request)
    {

        $cart = $this->getCart($request);

        $totalPrice = $cart->calculateTotalPrice();

        return view('shop.cart', compact('totalPrice'));
    }


    public function addProduct(Request $request)
    {
        $productRec = Product::where('id', $request->id)->firstOrFail();

        $cart = $this->getCart($request);

        $amount = $request->amount;

        $product = new \App\Product($productRec);

        if (!$product->qtyIsAvailable($amount)) {
            throw new \Exception('Запрашиваемое количество товара больше остатка !');
        }

        $cartProduct = new CartProduct($product,$amount);

        $cart->addToCart($cartProduct);

        return redirect(route('cart'));
    }


    public function removeProduct(Request $request): \Illuminate\Http\RedirectResponse
    {

        $cart = $this->getCart($request);
        $cart->removeFromCart($request->id);

        return redirect()->back();
    }

    public function clearCart(Request $request): \Illuminate\Http\RedirectResponse
    {
        $cart = $this->getCart($request);
        $cart->clear();

        return redirect()->back();
    }

    public function actualize(Request $request): \Illuminate\Http\RedirectResponse
    {
        $cart = $this->getCart($request);
        $cart->actualize();
        return redirect()->back();
    }

    public function toOrder(Request $request)
    {
        $cart = $this->getCart($request);
        $cart->actualize();
        $cart->toOrder();
    }

    public function correctAmount(Request $request)
    {
        $cart = $this->getCart($request);
        $amount = $request->amount;
        $id = $request->id;
        $cart->correctAmount($id,$amount);
        return redirect()->back();

    }


    private function getCart(Request $request): Cart
    {
        $repository = new CartRepository();
        return $repository->get($request);
    }

}
