<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Магазин') }}
        </h2>

    </x-slot>


@if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Покупатель</a>
                <a href="{{ url('/dashboard/seller') }}" class="text-sm text-gray-700 underline">Продавец</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Войти</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Регистрация</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

        <table class="table table-striped" dusk="product-table">
            <thead>
            @foreach($products as $product)

            </thead>
            <tbody>
                <tr>
                    <td>{{$product->name}}</td>
                    <td><img src="{{$product->main_photo_path}}" width="120px" height="120px"> </td>
                    <td>{{$product->price}} RUR</td>
                    <td> <a href="/product/{{$product->id}}">Подробнее</a></td>

                </tr>
            @endforeach
            </tbody>
        </table>


                </div>
            </div>

            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    (c) 2021 - Mega-Mall .inc
                </div>


            </div>
    </div>
</div>
</x-app-layout>
