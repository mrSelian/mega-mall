<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
