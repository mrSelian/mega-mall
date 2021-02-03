<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-evenly ">
            <a href="{{route('seller')}}"
               class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Кабинет Продавца') }}
            </a>
            <a href="{{route('seller_products')}}"
               class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Мои Товары') }}
            </a>
            <a href="{{route('create_product')}}"
               class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Добавить товар') }}
            </a>
            <a href="{{route('seller_orders')}}"
               class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Мои Заказы') }}
            </a>
        </div>
    </x-slot>


    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 overflow-x-auto">
        @include('layouts.errors')
        @if($products->isEmpty())
            Товаров нет.
        @else


            <table class=" max-w-7xl mx-auto  py-10 text-center  table-auto" dusk="product-table">
                <thead class="justify-between  ">
                <tr class="bg-gray-800">
                    <th class="px-5
                     py-2 ">
                        <span class="text-gray-300"></span>
                    </th>

                    <th class="px-5 py-2">
                        <span class="text-gray-300">Товар</span>
                    </th>

                    <th class="px-5 py-2">
                        <span class="text-gray-300">Цена</span>
                    </th>

                    <th class="px-5 py-2">
                        <span class="text-gray-300">Остаток</span>
                    </th>

                    <th class="px-5 py-2">
                        <span class="text-gray-300">Описание</span>
                    </th>

                    <th class="px-5 py-2">
                        <span class="text-gray-300">Действия</span>
                    </th>

                    <th class="px-5 py-2 ">
                        <span class="text-gray-300"></span>
                    </th>

                </tr>


                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class=" bg-white border-4 border-gray-200">
                        <td class="" ><img src="{{$product->main_photo_path}}" width="120px" height="120px"></td>
                        <td class="text-center ml-2 font-semibold">{{$product->name}}</td>
                        <td>{{$product->price}} &#8381;</td>
                        <td>{{$product->quantity}} шт.</td>
                        <td><a href="{{route('show_product',$product->id)}}"
                               class="bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black">
                                Подробнее </a></td>

                        <td>
                            <a href="{{ route('edit_product',$product->id)}}"
                               class="bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black"
                               dusk="edit-button">Изменить</a>
                        </td>
                        <td>
                            <form action="{{ route('destroy_product', $product->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-indigo-500 text-white px-4 mr-2 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black"
                                    type="submit" dusk="delete-button">Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    @endif


</x-app-layout>
