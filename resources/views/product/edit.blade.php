

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Редактировать Товар </h1>
            @include('layouts.errors')

            <form method="post" action="{{ route('update_product', $product->id ) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">

                    <label for="name">Название:*</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}" dusk="title-field" />
                </div>

                <div class="price">
                    <label for="full_specification">Цена:</label>
                    <input type="text" class="form-control" name="price" value="{{ $product->price }}" dusk="description-field" />
                </div>

                <div class="main_photo_path">
                    <label for="full_specification">Ссылка на фото:</label>
                    <input type="text" class="form-control" name="main_photo_path" value="{{ $product->main_photo_path }}" dusk="description-field" />
                </div>

                <div class="quantity">
                    <label for="full_specification">Количество:</label>
                    <input type="text" class="form-control" name="quantity" value="{{ $product->quantity }}" dusk="description-field" />
                </div>


                <div class="form-group">
                    <label for="full_specification">Описание:</label>
                    <input type="textarea" class="form-control" name="full_specification" value="{{ $product->full_specification }}" dusk="description-field" />
                </div>
                <button type="submit" class="btn btn-primary" dusk="submit-button">Изменить</button>
            </form>
        </div>
    </div>
