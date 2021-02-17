<?php

namespace App\Http\Controllers\Shop;

use App\Domain\ProductRepositoryInterface;
use App\Domain\SellerInfoRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private ProductRepositoryInterface $productRepository;
    private SellerInfoRepositoryInterface $sellerInfoRepository;

    public function __construct(ProductRepositoryInterface $productRepository, SellerInfoRepositoryInterface $sellerInfoRepository)
    {
        $this->productRepository = $productRepository;
        $this->sellerInfoRepository = $sellerInfoRepository;
    }

    public function shop()
    {
        $products = $this->productRepository->getAllAvailable();

        return view('shop.index', compact('products'));
    }

    public function showProduct($id)
    {
        $product = $this->productRepository->getById($id);

        return view('shop.product.show', compact('product'));
    }

    public function search(Request $request)
    {

    }

    public function sellerShop($id)
    {

        $products = $this->productRepository->getAllByUserId($id);

        $info = $this->sellerInfoRepository->getBySellerId($id);

        return view('shop.seller', compact('products', 'info'));
    }
}

