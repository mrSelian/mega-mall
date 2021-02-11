<x-app-layout>
    @include('layouts.headers.seller')
    @section('page-title')
        Профиль продавца
    @endsection

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if($info == null)
            <div>Вы ещё не добавили информацию о магазине.</div>
            <br>
            <a href="{{route('create_seller_info')}}"
               class=" bg-indigo-500 text-white px-4 py-2 border rounded-md  hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Добавить</a>
        @else
            Название магазина: {{$info->name}}
            <br>
            Информация о магазине: {{$info->info}}
            <br>
            Обложка магазина: {{$info->main_photo}}
            <br>
            Условия доставки: {{$info->delivery_terms}}
            <br>
            Ваш телефон: {{$info->phone}}
            <br>
            Ваш e-mail: {{$info->email}}
            <br>
            Дополнительный контакт: {{$info->additional_contact}}
            <br>
            <br>
            <a href="{{route('edit_seller_info')}}"
               class=" bg-indigo-500 text-white px-4 py-2 border rounded-md  hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Изменить</a>

            <a href="{{route('seller_page',Auth::user()->id)}}"
               class=" bg-indigo-500 text-white px-4 py-2 border float:right rounded-md  hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Как покупатели видят магазин?</a>
        @endif
    </div>
</x-app-layout>
