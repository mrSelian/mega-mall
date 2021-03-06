<x-app-layout>
    @include('layouts.headers.seller')
    @section('page-title')
        Добавление товара
    @endsection

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @include('layouts.errors')




    <div class="antialiased text-gray-900">

        <form action="{{route('store_product')}}" method="POST" class="form mt-4">
        <div class="mx-4 card bg-white max-w-md p-10 md:rounded-lg my-12 mx-auto">

                <label for="product" class=" control-label font-bold text-center"><h1>Добавить товар</h1></label>


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
                    <label for="name" class="font-bold mt-4 mb-2">Название</label>
                    <input name="name" id="product-name" value="{{old('product-name')}}" class="appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                           type="text" placeholder="Название товара">
                </div>

                <div class="flex flex-col text-sm">
                    <label for="mainPhotoPath" class="font-bold mt-4 mb-2">Фото</label>
                    <input name="mainPhotoPath" id="mainPhotoPath" value="{{old('mainPhotoPath')}}" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                           type="text" placeholder="Ссылка на фото товара">
                </div>

                <div class="flex flex-col text-sm">
                    <label for="price" class="font-bold mt-4 mb-2">Цена, &#8381; </label>
                    <input name="price" id="price" value="{{old('price')}}" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                           type="text" placeholder="Цена товара">
                </div>

                <div class="flex flex-col text-sm">
                    <label for="quantity" class="font-bold mt-4 mb-2">Количество, шт; </label>
                    <input name="quantity" id="quantity" value="{{old('quantity')}}" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                           type="text" placeholder="Количество товара">
                </div>

                <div class="text-sm flex flex-col">
                    <label for="fullSpecification" class="font-bold mt-4 mb-2">Описание</label>
                    <textarea
                        name="fullSpecification" id="fullSpecification"  class=" appearance-none w-full border border-gray-200 p-2 h-40 focus:outline-none focus:border-gray-500"
                        placeholder="Опишите ваш товар">{{old('fullSpecification')}}</textarea>
                </div>

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
