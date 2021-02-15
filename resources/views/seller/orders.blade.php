<x-app-layout>
    @include('layouts.headers.seller')
    @section('page-title')
        Управление заказами
    @endsection


    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if($orders->isEmpty())
            Вы ещё ничего не продали.
        @else

            <table class=" max-w-7xl mx-auto  py-10 text-center  table-auto" dusk="product-table">
                <thead class="justify-between  ">
                <tr class="bg-gray-800">

                    <th class="px-5 py-2">
                        <span class="text-gray-300">ID покупателя</span>
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

                    <th class="px-5 py-2">
                        <span class="text-gray-300">Смена статуса</span>
                    </th>


                </tr>


                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class=" bg-white border-4 border-gray-200">
                        <td >{{$order->customer_id}}</td>
                        <td>{{$order->sum}} &#8381;</td>
                        <td>{{$order->status}} </td>
                        <td><a href="{{route('order_page',$order->id)}}"
                               class="text-indigo-600 hover:underline">
                                Страница заказа </a></td>
                        <td>
                            <form action="{{ route('change_order_status', $order->id)}}" method="post">
                                @csrf
                                <label for="status" >
                                    <select name="status" id="status" required>
                                        <option>оформлен</option>
                                        <option>оплачен</option>
                                        <option>собран</option>
                                        <option>отправлен</option>
                                        <option>доставлен</option>
                                    </select>
                                </label>
                                <button
                                    class="bg-indigo-500 text-white px-4 mr-2 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black"
                                    type="submit" >Изменить
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        @endif





    </div>
</x-app-layout>
