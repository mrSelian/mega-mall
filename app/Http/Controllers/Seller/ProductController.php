<?php

namespace App\Http\Controllers\Seller;

use App\Domain\Product;
use App\Domain\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Http\RedirectResponse;
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

    public function store(CreateProductRequest $request): RedirectResponse
    {
        $product = Product::create(
            $request->name,
            $request->mainPhotoPath,
            $request->price,
            $request->quantity,
            $request->fullSpecification,
            Auth::id()
        );

        $this->productRepository->save($product);

        return redirect()->route('seller_products');
    }

    public function edit($id)
    {
        $product = $this->productRepository->getById($id);

        $this->authorize('edit', $product);

        return view('seller.product.edit', compact('product'));
    }

    public function update(CreateProductRequest $request, $id): RedirectResponse
    {
        $product = $this->productRepository->getById($id);

        $this->authorize('update', $product);

        $product->update(
            $request->name,
            $request->mainPhotoPath,
            $request->price,
            $request->quantity,
            $request->fullSpecification
        );

        $this->productRepository->save($product);

        return redirect()->route('seller_products')->with('success', 'Товар успешно обновлен.');
    }

    public function destroy($id): RedirectResponse
    {
        $product = $this->productRepository->getById($id);

        $this->authorize('destroy', $product);

        $product->delete();

        $this->productRepository->delete($product);

        return redirect()->route('seller_products')->with('success', 'Товар удалён.');
    }

    public function getProducts()
    {
        $products = $this->productRepository->getAllByUserId(Auth::id());

        return view('seller.products', compact('products'));
    }
}
