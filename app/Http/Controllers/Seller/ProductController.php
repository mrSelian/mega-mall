<?php

namespace App\Http\Controllers\Seller;

use App\Domain\Product;
use App\Domain\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
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
        $product = Product::create(
            $request->name,
            $request->main_photo_path,
            $request->price,
            $request->quantity,
            $request->full_specification,
            Auth::id()
        );

        $this->productRepository->save($product);

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
        $product = $this->productRepository->getById($id);

        $this->authorize('update', $product);

        $product->update(
            $request->name,
            $request->main_photo_path,
            $request->price,
            $request->quantity,
            $request->full_specification
        );

        $this->productRepository->save($product);

        return redirect(route('seller_products'))->with('success', 'Товар успешно обновлен.');
    }

    public function destroy($id)
    {
        $product = $this->productRepository->getById($id);

        $this->authorize('destroy', $product);

//      $product->delete();

        $this->productRepository->delete($product);

        return redirect(route('seller_products'))->with('success', 'Товар удалён.');
    }

    public function getSellerProducts()
    {
        $products = $this->productRepository->getAllByUserId(Auth::id());

        return view('seller.products', compact('products'));
    }
}
