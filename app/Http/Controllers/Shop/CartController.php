<?php

namespace App\Http\Controllers\Shop;

use App\Domain\CartRepositoryInterface;
use App\Domain\OrderRepositoryInterface;
use App\Domain\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class CartController extends Controller
{
    private CartRepositoryInterface $cartRepository;
    private ProductRepositoryInterface $productRepository;
    private OrderRepositoryInterface $orderRepository;

    public function __construct(CartRepositoryInterface $cartRepository,
                                ProductRepositoryInterface $productRepository,
                                OrderRepositoryInterface $orderRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {

        $cart = $this->cartRepository->get();
        $photos = $this->cartRepository->getPhotosForCart($cart);

        return view('shop.cart', compact('cart', 'photos'));
    }


    public function addProduct(Request $request): RedirectResponse
    {

        $cart = $this->cartRepository->get();
        $product = $this->productRepository->getById($request->id);

        $cart->addProduct($product, $request->amount);
        $this->cartRepository->save($cart);

        return redirect()->route('cart');
    }

    public function removeProduct(Request $request): RedirectResponse
    {

        $cart = $this->cartRepository->get();
        $cart->removeProduct($request->id);

        $this->cartRepository->save($cart);

        return redirect()->back();
    }

    public function actualize(): RedirectResponse
    {
        $cart = $this->cartRepository->get();
        $cart->actualize($this->productRepository);
        $this->cartRepository->save($cart);
        return redirect()->back();
    }

    public function toOrder(): RedirectResponse
    {
        $cart = $this->cartRepository->get();

        $order = $cart->toOrder($this->productRepository);
        $this->orderRepository->save($order);
        $this->cartRepository->save($cart);

        return redirect()->route('customer_orders');
    }

    public function clearCart(): RedirectResponse
    {
        $cart = $this->cartRepository->get();

        $cart->clear();
        $this->cartRepository->save($cart);

        return redirect()->back();
    }

    public function correctAmount(Request $request): RedirectResponse
    {
        $cart = $this->cartRepository->get();

        $product = $this->productRepository->getById($request->id);
        $cart->correctAmount($product, $request->amount);
        $this->cartRepository->save($cart);

        return redirect()->back();

    }

}
