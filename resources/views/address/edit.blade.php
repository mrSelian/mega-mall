<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-evenly ">
            <a href="{{route('customer')}}"
               class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Кабинет Покупателя') }}
            </a>
            <a href="{{route('customer_orders')}}"
               class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Мои Заказы') }}
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if($address==null)
            <div>Вы ещё не добавили адрес.</div>
            <br>
            <a href="{{route('create_address')}}"
               class=" bg-indigo-500 text-white px-4 py-2 border rounded-md  hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Добавить</a>

        @else


            <div class="antialiased text-gray-900">

                <form action="{{route('update_address')}}" method="POST" class="form mt-4">
                    @method('PATCH')
                    <div class="mx-4 card bg-white max-w-md p-10 md:rounded-lg my-12 mx-auto">
                        <label for="product" class=" control-label font-bold text-center"><h1>Изменить адрес</h1>
                        </label>


                        {{--        <div class="options md:flex md:space-x-6 text-sm items-center text-gray-700 mt-4">--}}
                        {{--            <p class="w-1/2 mb-2 md:mb-0">I would like to </p>--}}
                        {{--            <select class="w-full border border-gray-200 p-2 focus:outline-none focus:border-gray-500">--}}
                        {{--                <option value="select" selected>Select an option</option>--}}
                        {{--                <option value="bug">report a bug</option>--}}
                        {{--                <option value="feature">Request a feature</option>--}}
                        {{--                <option value="feedback">Feedback</option>--}}
                        {{--            </select>--}}
                        {{--        </div>--}}

                        @csrf
                        <div class="flex flex-col text-sm">
                            <label for="full_name" class="font-bold mt-4 mb-2">Полное Имя</label>
                            <input name="full_name" id="full_name" value="{{$address->full_name}}"
                                   class="appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                                   type="text" placeholder="Введите ФИО">
                        </div>

                        <div class="flex flex-col text-sm">
                            <label for="country" class="font-bold mt-4 mb-2">Страна</label>
                            <input name="country" id="country" value="{{$address->country}}"
                                   class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                                   type="text" placeholder="Страна">
                        </div>

                        <div class="flex flex-col text-sm">
                            <label for="region" class="font-bold mt-4 mb-2">Регион </label>
                            <input name="region" id="region" value="{{$address->region}}"
                                   class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                                   type="text" placeholder="Область, край, республика или штат">
                        </div>

                        <div class="flex flex-col text-sm">
                            <label for="city" class="font-bold mt-4 mb-2">Населенный пункт</label>
                            <input name="city" id="city" value="{{$address->city}}"
                                   class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                                   type="text" placeholder="Город, село и т.д.">
                        </div>

                        <div class="flex flex-col text-sm">
                            <label for="zip" class="font-bold mt-4 mb-2">Индекс</label>
                            <input name="zip" id="zip" value="{{$address->zip}}"
                                   class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                                   type="text" placeholder="Почтовый индекс">
                        </div>

                        <div class="flex flex-col text-sm">
                            <label for="street" class="font-bold mt-4 mb-2">Улица</label>
                            <input name="street" id="street" value="{{$address->street}}"
                                   class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                                   type="text" placeholder="Улица">
                        </div>

                        <div class="flex flex-col text-sm">
                            <label for="house" class="font-bold mt-4 mb-2">Номер дома</label>
                            <input name="house" id="house" value="{{$address->house}}"
                                   class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                                   type="text" placeholder="Номер дома">
                        </div>

                        <div class="flex flex-col text-sm">
                            <label for="apt" class="font-bold mt-4 mb-2">Номер квартиры/Комнаты/Офиса</label>
                            <input name="apt" id="apt" value="{{$address->apt}}"
                                   class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                                   type="text" placeholder="Ставьте прочерк если отсутствует">
                        </div>

                        @include('layouts.errors')


                        <div class="submit">
                            <button type="submit"
                                    class=" w-full bg-indigo-500 text-white px-4 py-2 mt-6 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
                                Сохранить изменения
                            </button>
                        </div>
                </form>
            </div>
        @endif
    </div>

    </div>
</x-app-layout>

