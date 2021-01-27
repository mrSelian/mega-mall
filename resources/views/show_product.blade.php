<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$product->name}}
        </h2>

    </x-slot>

    <!-- Product Details -->
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="product_details">
            <div class="container">
                <div class="row details_row">

                    <!-- Product Image -->
                    <div class="col-lg-6">
                        <div class="details_image">
                            @php
                                $image = $product->main_photo_path;
                            @endphp
                            <div class="details_image_large"><img src="{{$image}}">
                            </div>
                            <div
                                class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                            </div>
                        </div>
                    </div>

                    <!-- Product Content -->
                    <div class="col-lg-6">
                        <div class="details_content">
                            <div class="details_name" data-id="{{$product->id}}">{{$product->name}}</div>
                            <div class="details_price">{{$product->price}} RUR</div>

                                            <!-- In Stock -->
                                                <div class="in_stock_container">
                                                    <div class="availability">Доступность:</div>
                                                    @if($product->quantity > 0)
                                                        <span style="color: green">В наличии</span>
                                                    @else
                                                        <span style="color: #cc0000">Отсутствует</span>
                                                    @endif
                                                </div>


                        <!-- Product Quantity -->
                            <div class="product_quantity_container">
                                <div class="product_quantity clearfix">
                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                    <span>шт</span>
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i
                                                class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i
                                                class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                                <div class="button cart_button"><a href="#">Добавить в корзину</a></div>
                            </div>
                            <div class="row description_row">
                                <div class="col">
                                    <div class="description_title_container">
                                        <div class="description_title">Описание</div>
                                    </div>
                                    <div class="description_text">
                                        <p>{{$product->full_specification}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
