<x-app-layout>
    <x-slot name="header">
        <x-jet-nav-link href="{{ route('customer_orders') }}" :active="request()->routeIs('customer_orders')">
            {{ __('К истории покупок') }}
        </x-jet-nav-link>
        @section('page-title')
            Заказ - Покупатель
        @endsection
    </x-slot>
    <div class="bg-gray-100">
        <div class="container mx-auto mt-10 ">
            <div class="flex shadow-md  my-10">
                <div class="w-3/4 bg-white px-10 py-10">
                    <div class="flex justify-between border-b pb-8">
                        <h1 class="font-semibold text-2xl">Товары в заказе:</h1>

                    </div>
                    <div class="flex justify-evenly mt-10 mb-5">
                        <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/4">Товар</h3>


                        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/4 text-center">
                            Цена</h3>

                        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/4 text-center">
                            Количество</h3>

                        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/4 text-center">
                            Сумма</h3>
                    </div>
                    @php
                        $products =  $order->getProducts();
                    @endphp

                    @foreach($products as $product)
                        <div class="flex justify-evenly hover:bg-gray-100 -mx-8 px-6 py-5">
                            <div class="flex w-1/4"> <!-- product -->

                                <div class="flex flex-col justify-between ml-4 flex-grow">
                                    <span class="font-bold text-sm">{{$product->getName()}}</span>

                                    <a href="{{route('show_product',$product->getId())}}"
                                       class="font-semibold hover:text-red-500 text-gray-500 text-xs">Подробнее</a>
                                </div>
                            </div>

                            <span
                                class="text-center w-1/4 font-semibold text-sm">{{$product->getPrice()}} &#8381;</span>


                            <span
                                class="text-center w-1/4 font-semibold text-sm">{{$product->getAmount()}}</span>


                            <span class="text-center w-1/4 font-semibold text-sm">{{$product->getPrice() * $product->getAmount()}} &#8381;</span>

                        </div>

                    @endforeach
                </div>
                <div id="summary" class="w-1/4 px-8 py-10">
                    <h1 class="font-semibold text-2xl">О заказе</h1>
                    <div class="border-t mt-8">
                        <div class="flex font-semibold justify-between py-3 text-sm uppercase">
                            <span>Итоговая сумма:</span>
                            <span> {{$order->getSum()}} &#8381;</span>
                        </div>

                        <div class="flex font-semibold justify-between py-3 text-sm uppercase">
                            <span>Статус:</span>
                            <span> {{$order->getStatus()}} </span>
                        </div>
                        <h1 class="font-semibold text-2xl mt-4">О продавце</h1>
                        <div class="border-t mt-8">
                            <div class="flex font-semibold justify-between py-3 text-sm uppercase">
                                <span>E-mail:</span>
                                <span> {{$info->email}} </span>
                            </div>
                            @if($info->phone != null)
                                <div class="flex font-semibold justify-between py-3 text-sm uppercase">
                                    <span>Телефон:</span>
                                    <span> {{$info->phone}} </span>
                                </div>
                            @endif
                            @if($info->additional_contact != null)
                                <div class="flex font-semibold justify-between py-3 text-sm uppercase">
                                    <span>Дополнительно:</span>
                                    <span> {{$info->additional_contact}} </span>
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
