<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-evenly ">
            <a href="{{route('seller')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Кабинет Продавца') }}
            </a>
            <a href="{{route('seller_products')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Мои Товары') }}
            </a>
            <a href="{{route('create_product')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Добавить товар') }}
            </a>
            <a href="{{route('seller_orders')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Мои Заказы') }}
            </a>
        </div>
    </x-slot>

    <div>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @include('layouts.errors')
            @if($products->isEmpty())
                Товаров нет.
            @else


            <table class="table table-striped" dusk="product-table">
                <thead>

                @foreach($products as $product)

                </thead>
                <tbody>
                <tr>
                    <td>{{$product->name}}</td>
                    <td><img src="{{$product->main_photo_path}}" width="120px" height="120px"></td>
                    <td>{{$product->full_specification}} </td>
                    <td>{{$product->price}} &#8381;</td>
                    <td>{{$product->quantity}} шт.</td>

                </tr>
                <td>
                    <a href="{{ route('edit_product',$product->id)}}" class="btn btn-primary" dusk="edit-button">Изменить</a>
                </td>
                <td>
                    <form action="{{ route('destroy_product', $product->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" dusk="delete-button">Удалить</button>
                    </form>
                </td>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>




</x-app-layout>
