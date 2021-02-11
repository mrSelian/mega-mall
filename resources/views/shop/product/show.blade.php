<x-app-layout>
    <x-slot name="header">
        @section('page-title')
            {{$product->name}}
        @endsection
    </x-slot>

    <!-- Product Details -->
    <div class="max-w-2xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="product_details bg-white shadow-xl rounded-lg overflow-hidden ">
            <div class="container">
                <div class="row details_row">

                    <!-- Product Image -->
                    <div class="col-lg-6 ">
                        <div class="details_image ">
                            @php
                                $image = $product->main_photo_path;
                            @endphp
                            <div class="details_image_large "><img src="{{$image}}">
                            </div>
                            <div
                                class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                            </div>
                        </div>
                    </div>

                    <!-- Product Content -->
                    <div class="col-lg-6">
                        <div class="px-2 details_content">
                            <div class="details_name uppercase tracking-wide mb-3 text-lg font-semibold text-gray-700 " data-id="{{$product->id}}">{{$product->name}}</div>
                            <!-- In Stock -->
                            <div class="in_stock_container tracking-wide font-semibold  mb-1 ">
                                @if($product->quantity > 0)
                                    <span class="" style="color: green">В наличии: <br>{{$product->quantity}} шт</span>
                                @else
                                    <span style="color: red">Отсутствует</span>
                                @endif
                            </div>
                            <div class="details_price text-3xl text-gray-900 mb-3">{{$product->price}} &#8381;</div>



                            <form action="{{route('add_to_cart',$product->id)}}" target="_blank" method="POST"  class="form-horizontal">
                            @csrf
                        <!-- Product Quantity -->
                            <div class="product_quantity_container">
                                <div class="product_quantity clearfix">
                                    <label for="amount"></label><input name="amount" id="amount" pattern="[0-9]*" type="text"  value="1">
                                    <span>шт</span>
{{--                                    <div class="quantity_buttons">--}}
{{--                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i--}}
{{--                                                class="fa fa-chevron-up" aria-hidden="true"></i></div>--}}
{{--                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i--}}
{{--                                                class="fa fa-chevron-down" aria-hidden="true"></i></div>--}}
{{--                                    </div>--}}
                                </div>

                            </div>
                                <div class="px-2 row description_row mb-2 mt-2">
                                    <div class="col">
                                        <div class="description_title_container">
                                            <div class="tracking-wide text-xl font-semibold text-gray-700 description_title">Описание</div>
                                        </div>
                                        <div class="description_text text-lg">
                                            <p>{{$product->full_specification}}</p>
                                        </div>
                                    </div>
                                    <a href="{{route('seller_page',$product->user_id)}}" class="flex font-semibold text-indigo-600 text-sm mt-4">

                                        <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                                            <path
                                                d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/>
                                        </svg>
                                        Магазин продавца
                                    </a>
                                </div>



                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="{{$product->id}}">
                                <div class="col-sm-offset-3 col-sm-6">
                                    @if($product->quantity < 1)
                                        <button type="submit" class="text-xl w-full bg-gray-800 text-white px-4 py-2 border disabled:opacity-40 rounded-md  " disabled>
                                            <i class="fa fa-plus"></i> Добавить в корзину
                                        </button>
                                    @else
                                    <button type="submit" class="text-xl w-full bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black">
                                        <i class="fa fa-plus"></i> Добавить в корзину
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
