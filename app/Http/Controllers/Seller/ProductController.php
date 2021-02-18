<?php

namespace App\Http\Controllers\Seller;

use App\Domain\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create()
    {
        return view('seller.product.create');
    }


    public function store(CreateProductRequest $request)
    {
        $this->productRepository->create($request);

        return redirect(route('seller_products'));
    }

    public function edit($id)
    {
        $product = $this->productRepository->getById($id);

        $this->authorize('edit', $product);

        return view('seller.product.edit', compact('product'));
    }

    public function update(CreateProductRequest $request, $id)
    {

        $this->authorize('update', $this->productRepository->getById($id));

        $this->productRepository->update($request, $id);

        return redirect(route('seller_products'))->with('success', 'Товар успешно обновлен.');
    }

    public function destroy($id)
    {
        $product = $this->productRepository->getById($id);

        $this->authorize('destroy', $product);

        $this->productRepository->delete($id);

        return redirect(route('seller_products'))->with('success', 'Товар удалён.');
    }

    public function getSellerProducts()
    {
        $products = $this->productRepository->getAllByUserId(Auth::id());

        return view('seller.products', compact('products'));
    }
}
