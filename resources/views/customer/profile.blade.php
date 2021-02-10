<x-app-layout>
    @include('layouts.headers.customer')
    @section('page-title')
        Профиль покупателя
    @endsection

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if($info == null)
            <div>Вы ещё не добавили контактную информацию.</div>
            <br>
            <a href="{{route('create_customer_info')}}"
               class=" bg-indigo-500 text-white px-4 py-2 border rounded-md  hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Добавить</a>
        @else
            Ваш телефон: {{$info->phone}}
            <br>
            Ваш e-mail: {{$info->email}}
            <br>
            Дополнительный контакт: {{$info->additional_contact}}
            <br>
            <br>
                <a href="{{route('edit_customer_info')}}"
                   class=" bg-indigo-500 text-white px-4 py-2 border rounded-md  hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Изменить</a>

        @endif
    </div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if($address == null)
            <div>Вы ещё не добавили адрес.</div>
            <br>
            <a href="{{route('create_address')}}"
               class=" bg-indigo-500 text-white px-4 py-2 border rounded-md  hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Добавить</a>
        @else
            Ваш Текущий Адрес:
            <br>
            {{$address->full_name}}
            <br>
            {{$address->zip}}
            <br>
            {{$address->country}}
            <br>
            {{$address->region}}
            <br>
            {{$address->city}}
            <br>
            {{$address->street}}
            <br>
            {{$address->house}}
            <br>
            {{$address->apt}}
            <br>
            <br>
            <a href="{{route('edit_address')}}"
               class=" bg-indigo-500 text-white px-4 py-2 border rounded-md  hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Изменить</a>

        @endif
    </div>
</x-app-layout>
