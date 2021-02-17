<x-app-layout>
    <x-slot  name="header">
    </x-slot>

    @section('page-title')
        Корзина
    @endsection
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @include('layouts.errors')


    </div>
    <div class="bg-gray-100">
        <div class="container mx-auto mt-10 ">
            <div class="flex shadow-md my-10">
                <div class="w-3/4 bg-white px-10 py-10">
                    <div class="flex justify-between border-b pb-8">
                        <h1 class="font-semibold text-2xl">Товары в корзине:</h1>

                    </div>
                    <div class="flex justify-evenly mt-10 mb-5">
                        <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Товар</h3>


                        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">
                            Цена</h3>

                        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">
                            Количество</h3>

                        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">
                            Сумма</h3>
                    </div>
                    @php
                        $products =  $cart->getProducts();
                    @endphp
                    @if($products == [])
                    <h1 class="text-center font-semibold text-2xl">Корзина пуста</h1>
                    @else

                    @foreach($products as $product)
                    <div class="flex justify-evenly hover:bg-gray-100 -mx-8 px-6 py-5">
                        <div class="flex w-2/5"> <!-- product -->
                            <div class="w-20">
                                <img class="h-24" src="{{$photos[$product->getId()]}}}}"
                                     alt="">
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm">{{$product->getName()}}</span>

                                <a href="{{route('show_product',$product->getId())}}" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Подробнее</a>

                                <form action="{{ route('remove_from_cart', $product->getId())}}" method="post">
                                    @csrf
                                <button class="font-semibold hover:text-red-500 text-gray-500 text-xs">Удалить</button>
                                </form>
                            </div>
                        </div>
                        <span class="text-center w-1/5 font-semibold text-sm">{{$product->getPrice()}} &#8381;</span>
                        <div class="flex justify-center w-1/5">
{{--                            <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">--}}
{{--                                <path--}}
{{--                                    d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>--}}
{{--                            </svg>--}}
                            <form action="{{ route('correct_amount', $product->getId())}}" method="post">
                                @csrf
                                <label for="amount"></label><input class="mx-2 border text-center w-14 h-8" type="text" pattern="[0-9]*" name="amount" id="amount" value="{{$product->getAmount()}}" >

                                    <br>
                                <button class="font-semibold hover:text-red-500 text-gray-500 text-xs">Изменить</button>
                            </form>
{{--                            <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">--}}
{{--                                <path--}}
{{--                                    d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>--}}
{{--                            </svg>--}}
                        </div>
                        <span class="text-center w-1/5 font-semibold text-sm">{{$product->getPrice() * $product->getAmount()}} &#8381;</span>
                    </div>
                    @endforeach
                    @endif

                    <a href="{{route('index')}}" class="flex font-semibold text-indigo-600 text-sm mt-10">

                        <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                            <path
                                d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/>
                        </svg>
                        Продолжить покупки
                    </a>

                    <form action="{{ route('clear_cart')}}" method="POST">
                        @csrf
                    <button  class="float-right bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase ">Очистить корзину</button>
                    </form>
                </div>

                <div id="summary" class="w-1/4 px-8 py-10">
                    <h1 class="font-semibold text-2xl">Заказ</h1>
                    <div class="border-t mt-8">
                        <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                            <span>Итоговая сумма:</span>
                            <span> {{$cart->calculateTotalPrice()}} &#8381;</span>
                        </div>
                        <form action="{{ route('cart_to_order')}}" method="POST">
                            @csrf
                        <button
                            class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">
                            Оформить
                        </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
