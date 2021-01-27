@section('content')


    <!-- Product Details -->

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
                        <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                        </div>
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-lg-6">
                    <div class="details_content">
                        <div class="details_name" data-id="{{$product->id}}">{{$product->name}}</div>
                        <div class="details_price">${{$product->price}}</div>

                    {{--                    <!-- In Stock -->--}}
                    {{--                        <div class="in_stock_container">--}}
                    {{--                            <div class="availability">Availability:</div>--}}
                    {{--                            @if($item->in_stock)--}}
                    {{--                                <span>In Stock</span>--}}
                    {{--                            @else--}}
                    {{--                                <span style="color: #cc0000">Unavailable</span>--}}
                    {{--                            @endif--}}
                    {{--                        </div>--}}
                    {{--                        <div class="details_text">--}}
                    {{--                            <p>{{$item->description}}</p>--}}
                    {{--                        </div>--}}

                    <!-- Product Quantity -->
                        <div class="product_quantity_container">
                            <div class="product_quantity clearfix">
                                <span>шт</span>
                                <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
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
