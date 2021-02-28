<?php

namespace App\Http\Controllers\Shop;

use App\Domain\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function showShop()
    {
        $products = $this->productRepository->getAllAvailable();

        return view('shop.index', compact('products'));
    }

    public function show($id)
    {
        $product = $this->productRepository->getById($id);

        return view('shop.product.show', compact('product'));
    }

    public function search(Request $request)
    {

    }

}
