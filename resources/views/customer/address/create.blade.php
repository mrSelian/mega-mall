<x-app-layout>
    @include('layouts.headers.customer')
    @section('page-title')
        Добавление адреса
    @endsection
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">





        <div class="antialiased text-gray-900">

            <form action="{{route('store_address')}}" method="POST" class="form mt-4">
                <div class="mx-4 card bg-white max-w-md p-10 md:rounded-lg my-12 mx-auto">
                    <label for="product" class=" control-label font-bold text-center"><h1>Добавить адрес</h1></label>


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
                        <label for="fullName" class="font-bold mt-4 mb-2">Полное Имя</label>
                        <input name="fullName" id="fullName" value="{{old('fullName')}}" class="appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" placeholder="Введите ФИО">
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="country" class="font-bold mt-4 mb-2">Страна</label>
                        <input name="country" id="country" value="{{old('country')}}" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" placeholder="Страна">
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="region" class="font-bold mt-4 mb-2">Регион </label>
                        <input name="region" id="region" value="{{old('region')}}" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" placeholder="Область, край, республика или штат">
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="city" class="font-bold mt-4 mb-2">Населенный пункт</label>
                        <input name="city" id="city" value="{{old('city')}}" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" placeholder="Город, село и т.д.">
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="zip" class="font-bold mt-4 mb-2">Индекс</label>
                        <input name="zip" id="zip" value="{{old('zip')}}" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" placeholder="Почтовый индекс">
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="street" class="font-bold mt-4 mb-2">Улица</label>
                        <input name="street" id="street" value="{{old('street')}}" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" placeholder="Улица">
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="house" class="font-bold mt-4 mb-2">Номер дома</label>
                        <input name="house" id="house" value="{{old('house')}}" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" placeholder="Номер дома">
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="apt" class="font-bold mt-4 mb-2">Номер квартиры/Комнаты/Офиса</label>
                        <input name="apt" id="apt" value="{{old('apt')}}" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" placeholder="Ставьте прочерк если отсутствует">
                    </div>

                    @include('layouts.errors')


                    <div class="submit">
                        <button type="submit"
                                class=" w-full bg-indigo-500 text-white px-4 py-2 mt-6 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
                            Добавить
                        </button>
                    </div>
            </form>
        </div>

    </div>

    </div>
</x-app-layout>
