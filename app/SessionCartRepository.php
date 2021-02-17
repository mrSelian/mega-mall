<?php

namespace App;


use App\Domain\Cart;
use App\Domain\CartProduct;
use App\Domain\CartRepositoryInterface;
use App\Domain\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SessionCartRepository implements CartRepositoryInterface
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function get(): Cart
    {
        $cart = [
            'customerId' => Auth::id(),
            'sellerId' => null,
            'products' => []
        ];

        if (session()->has('cart')) {
            $cart = (session()->get('cart'));
            $cart['products'] = array_map(fn(array $product) => CartProduct::fromArray($product), $cart['products']);
        }

        return new Cart($cart['customerId'],$cart['sellerId'], $cart['products']);
    }


    public function getPhotosForCart(Cart $cart): array
    {
        $photos = [];
        foreach ($cart->getProductsIds() as $productId) {
            $photos[$productId] = $this->productRepository->getPhoto($productId);
        }
        return $photos;
    }

    public function save(Cart $cart)
    {
        session()->put('cart', $cart->toArray());
    }

}
