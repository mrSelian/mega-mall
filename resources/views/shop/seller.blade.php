<x-app-layout>
    <x-slot name="header">
        @section('page-title')
            @if($info == null) Магазин
            @else
                {{$info->name}}
            @endif
        @endsection
    </x-slot>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        @if($info == null) Продавец ещё не разместил информацию о магазине.
        <div class="px-2 row description_row mb-2 mt-2">
            <div class="col">
                <div class="description_title_container">
                    <div
                        class="tracking-wide text-center text-xl font-semibold text-gray-700 description_title">
                        Товары в магазине:
                    </div>
                </div>
            </div>

        </div>
        @else
            <div class="product_details bg-blue-100  rounded-lg overflow-hidden ">
                <div class="container">
                    <div class="row details_row">

                        <div class="col-lg-6 mb-2 ">
                            <div class="details_image ">
                                @php
                                    $image = $info->main_photo;
                                @endphp
                                <div class="details_image_large   "><img width="1546px" height="423px" src="{{$image}}">
                                </div>
                                <div
                                    class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="px-2 details_content">
                                <div
                                    class="details_name text-center uppercase tracking-wide mb-3 text-lg font-semibold text-gray-700 "
                                >{{$info->name}}</div>

                                <div class="px-2 row description_row mb-3 mt-3">
                                    <div class="col">
                                        <div class="description_title_container">
                                            <div
                                                class="tracking-wide text-xl font-semibold text-gray-700 description_title">
                                                О магазине:
                                            </div>
                                        </div>
                                        <div class="description_text text-lg">
                                            <p>{{$info->info}}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="px-2 row description_row mb-2 mt-2">
                                    <div class="col">
                                        <div class="description_title_container">
                                            <div
                                                class="tracking-wide text-xl font-semibold text-gray-700 description_title">
                                                О доставке:
                                            </div>
                                        </div>
                                        <div class="description_text text-lg">
                                            <p>{{$info->delivery_terms}}</p>
                                        </div>
                                    </div>

                                </div>


                                <div class="px-2 row description_row mb-2 mt-2">
                                    <div class="col">
                                        <div class="description_title_container">
                                            <div
                                                class="tracking-wide text-xl font-semibold text-gray-700 description_title">
                                                Контакты продавца:
                                            </div>
                                        </div>
                                        <div class="description_text text-lg">
                                            <p>E-mail: {{$info->email}}</p>
                                            @if($info->phone != null)
                                                <p>Телефон: {{$info->phone}}</p>
                                            @endif
                                            @if($info->additional_contact != null)
                                                <p>{{$info->additional_contact}}</p>
                                            @endif

                                        </div>
                                    </div>

                                </div>

                                <div class="px-2 row description_row mb-2 mt-2">
                                    <div class="col">
                                        <div class="description_title_container">
                                            <div
                                                class="tracking-wide text-center text-xl font-semibold text-gray-700 description_title">
                                                Товары в магазине:
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="flex flex-wrap max-w-6xl mx-auto ">

                    @foreach($products as $product)
                        @if($product->getAmount() < 1 )
                            @continue
                        @endif
                        <div class="max-w-sm w-full sm:w-1/2 lg:w-1/3 py-6 px-3">
                            <div class="bg-white shadow-xl rounded-lg overflow-hidden">

                                <div class="bg-cover bg-center h-56 p-4"
                                     style="background-image: url({{$product->getPhoto()}})">
                                    {{--                                <div class="flex justify-end">--}}
                                    {{--                                                                <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">--}}
                                    {{--                                                                    <path d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"></path>--}}
                                    {{--                                                                </svg>--}}
                                    {{--                                </div>--}}
                                </div>
                                <div class="p-4">
                                    <p class="uppercase tracking-wide text-lg font-semibold text-gray-700">{{$product->getName()}}</p>
                                    <p class="text-3xl text-gray-900 mb-3">{{$product->getPrice()}} &#8381;</p>

                                    <a href="{{route('show_product',$product->getId())}}"
                                       class="float-right bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Подробнее</a>
                                    <form action="{{route('add_to_cart',$product->getId())}}" target="_blank"
                                          method="POST"
                                          class="form-horizontal">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="amount" id="amount" value="1">
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <button type="submit"
                                                        class="bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black font-semibold ">
                                                    <i class="fa fa-plus"></i> В корзину
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>



{{--            <div class="max-w-sm sm:w-1/2 lg:w-1/3 py-6 px-3"> {{ $products->links() }} </div>--}}
    </div>
</x-app-layout>
