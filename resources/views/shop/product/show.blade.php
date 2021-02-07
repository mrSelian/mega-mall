<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$product->name}}
        </h2>

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
                                    <label for="amount"></label><input name="amount" id="amount" type="text"  value="1">
                                    <span>шт</span>
{{--                                    <div class="quantity_buttons">--}}
{{--                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i--}}
{{--                                                class="fa fa-chevron-up" aria-hidden="true"></i></div>--}}
{{--                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i--}}
{{--                                                class="fa fa-chevron-down" aria-hidden="true"></i></div>--}}
{{--                                    </div>--}}
                                </div>

                            </div>
                                <div class="px-2 row description_row mb-3">
                                    <div class="col">
                                        <div class="description_title_container">
                                            <div class="tracking-wide text-xl font-semibold text-gray-700 description_title">Описание</div>
                                        </div>
                                        <div class="description_text text-lg">
                                            <p>{{$product->full_specification}}</p>
                                        </div>
                                    </div>
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
