<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @include('layouts.errors')
    <form action="/product/create" method="POST" class="form-horizontal">
        @csrf


        <div class="form-group">
            <label for="product" class="col-sm-3 control-label">Добавить товар</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="product-name" class="form-control" placeholder="Название">
            </div>
            <div class="col-sm-6">
                <input type="text" name="main_photo_path" id="main_photo_path" class="form-control" placeholder="Фото(URL)">
            </div>
            <div class="col-sm-6">
                <input type="text" name="price" id="price" class="form-control" placeholder="Цена">
            </div>
            <div class="col-sm-6">
                <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Количество">
            </div>
            <div class="col-sm-6">
                <input type="text" name="full_specification" id="full_specification" class="form-control" placeholder="Описание">
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

    <table class="table table-striped" dusk="product-table">
        <thead>
        @foreach($products as $product)

        </thead>
        <tbody>
        <tr>
            <td>{{$product->name}}</td>
            <td><img src="{{$product->main_photo_path}}" width="120px" height="120px"> </td>
            <td>{{$product->price}} RUR</td>
            <td>{{$product->quantity}} шт.</td>

        </tr>
        <td>
            <a href="{{ route('edit_product',$product->id)}}" class="btn btn-primary"dusk="edit-button">Изменить</a>
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
</x-app-layout>
