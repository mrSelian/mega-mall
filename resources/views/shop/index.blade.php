<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Магазин') }}
        </h2>

    </x-slot>


    <div class="flex flex-wrap max-w-6xl mx-auto ">

        @foreach($products as $product)


            <div class="max-w-sm w-full sm:w-1/2 lg:w-1/3 py-6 px-3">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden">

                    <div class="bg-cover bg-center h-56 p-4"
                         style="background-image: url({{$product->main_photo_path}})">
                        {{--                                <div class="flex justify-end">--}}
                        {{--                                                                <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">--}}
                        {{--                                                                    <path d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"></path>--}}
                        {{--                                                                </svg>--}}
                        {{--                                </div>--}}
                    </div>
                    <div class="p-4">
                        <p class="uppercase tracking-wide text-lg font-semibold text-gray-700">{{$product->name}}</p>
                        <p class="text-3xl text-gray-900 mb-3">{{$product->price}}  &#8381;</p>

                        <a href="{{route('show_product',$product->id)}}" class="float-right bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Подробнее</a>
                        <form action="{{route('add_to_cart',$product->id)}}" target="_blank" method="POST"
                              class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="{{$product->id}}">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black font-semibold ">
                                        <i class="fa fa-plus"></i> Добавить в корзину
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>


        @endforeach
        <div class="max-w-sm sm:w-1/2 lg:w-1/3 py-6 px-3"> {{ $products->links() }} </div>
    </div>


    </div>
    </div>

    <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
        <div class="text-center text-sm text-gray-500 sm:text-left">
            (c) 2021 - Mega-Mall .inc
        </div>


    </div>
    </div>


</x-app-layout>
