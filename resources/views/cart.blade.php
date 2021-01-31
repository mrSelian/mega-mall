<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Корзина') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @include('layouts.errors')
        @php
           // echo '<pre>';
         //  var_dump(session('cart'));

        @endphp
        <table class="table table-striped" dusk="product-table">
            <thead>
            @php
             $products = session('cart')->getProducts();
            @endphp
            @foreach($products as $product)

            </thead>
            <tbody>
            <tr>
                <td>{{$product->getName()}}</td>
                <td><img src="{{$product->getPhoto()}}" width="120px" height="120px"></td>
                <td>{{$product->getPrice()}} RUR</td>
                <td>{{$product->getFullSpec()}} </td>

            </tr>

            <td>
                <form action="{{ route('remove_from_cart', $product->getId())}}" method="post">
                    @csrf
                    <button class="btn btn-danger" type="submit" dusk="delete-button">Удалить</button>
                </form>
            </td>
            @endforeach
            </tbody>
        </table>
        <br>
  Итоговая сумма: {{$totalPrice}} RUR
        <br>

        <form action="/cart/actualize" method="POST" class="form-horizontal">
            @csrf

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Актуализировать
                    </button>
                </div>
            </div>
        </form>

        <form action="/cart/clear" method="POST" class="form-horizontal">
            @csrf

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Очистить Корзину
                    </button>
                </div>
            </div>
        </form>





    </div>

</x-app-layout>
