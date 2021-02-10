<x-app-layout>
  @include('layouts.headers.seller')
    @section('page-title')
        Продаваемые товары
    @endsection

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 overflow-x-auto">
        @include('layouts.errors')

        <a href="{{ route('create_product')}}"
           class="float-right bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black"
           dusk="edit-button">Добавить Товар</a>

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
