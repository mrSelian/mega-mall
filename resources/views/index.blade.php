<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Магазин') }}
        </h2>

    </x-slot>


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
