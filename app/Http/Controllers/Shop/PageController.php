<?php

namespace App\Http\Controllers\Shop;

use App\Domain\ProductRepositoryInterface;
use App\Domain\ShopProfileRepositoryInterface;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    private ProductRepositoryInterface $productRepository;
    private ShopProfileRepositoryInterface $sellerInfoRepository;

    public function __construct(ProductRepositoryInterface $productRepository, ShopProfileRepositoryInterface $sellerInfoRepository)
    {
        $this->productRepository = $productRepository;
        $this->sellerInfoRepository = $sellerInfoRepository;
    }


    public function sellerShop($id)
    {

        $products = $this->productRepository->getAllByUserId($id);

        $info = $this->sellerInfoRepository->getBySellerId($id);

        return view('shop.seller', compact('products', 'info'));
    }
}

