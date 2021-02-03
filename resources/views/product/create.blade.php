<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-evenly ">
            <a href="{{route('seller')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Кабинет Продавца') }}
            </a>
            <a href="{{route('seller_products')}}"
               class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
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

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @include('layouts.errors')

        <form action="{{route('store')}}" method="POST" class="form-horizontal">
            @csrf


            <div class="form-group">
                <label for="product" class="col-sm-3 control-label">Добавить товар</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="product-name" class="form-control" placeholder="Название">
                </div>
                <div class="col-sm-6">
                    <input type="text" name="main_photo_path" id="main_photo_path" class="form-control"
                           placeholder="Фото(URL)">
                </div>
                <div class="col-sm-6">
                    <input type="text" name="price" id="price" class="form-control" placeholder="Цена">
                </div>
                <div class="col-sm-6">
                    <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Количество">
                </div>
                <div class="col-sm-6">
                    <input type="text" name="full_specification" id="full_specification" class="form-control"
                           placeholder="Описание">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
