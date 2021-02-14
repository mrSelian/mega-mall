<x-app-layout>
    @include('layouts.headers.customer')
    @section('page-title')
        История покупок
    @endsection
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if($orders->isEmpty())
            Вы ещё ничего не покупали.
        @else

            <table class=" max-w-7xl mx-auto  py-10 text-center  table-auto" dusk="product-table">
                <thead class="justify-between  ">
                <tr class="bg-gray-800">

                    <th class="px-5 py-2">
                        <span class="text-gray-300">Продавец</span>
                    </th>

                    <th class="px-5 py-2">
                        <span class="text-gray-300">Сумма </span>
                    </th>


                    <th class="px-5 py-2">
                        <span class="text-gray-300">Статус</span>
                    </th>

                    <th class="px-5 py-2">
                        <span class="text-gray-300">Подробнее</span>
                    </th>


                </tr>


                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class=" bg-white border-4 border-gray-200">
                        <td ><a href="{{route('seller_page',$order->seller_id)}}" target="_blank" class="text-indigo-600 hover:underline">Магазин продавца</a></td>
                        <td>{{$order->sum}} &#8381;</td>
                        <td>{{$order->status}} </td>
                        <td><a href="{{route('order_page',$order->id)}}"
                               class="text-indigo-600 hover:underline">
                                Страница заказа </a></td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        @endif





    </div>

</x-app-layout>
