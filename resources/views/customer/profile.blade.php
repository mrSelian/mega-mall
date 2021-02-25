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
            @if($info->getPhone() != null)  Ваш телефон: {{$info->getPhone()}}}@endif
            <br>
            Ваш e-mail: {{$info->getEmail()}}
            <br>
            @if($info->getAdditionalContact() != null) Дополнительный контакт: {{$info->getAdditionalContact()}}@endif
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
            {{$address->getFullName()}}
            <br>
            {{$address->getZip()}}
            <br>
            {{$address->getCountry()}}
            <br>
            {{$address->getRegion()}}
            <br>
            {{$address->getCity()}}
            <br>
            {{$address->getStreet()}}
            <br>
            {{$address->getHouse()}}
            <br>
            {{$address->getApt()}}
            <br>
            <br>
            <a href="{{route('edit_address')}}"
               class=" bg-indigo-500 text-white px-4 py-2 border rounded-md  hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Изменить</a>

        @endif
    </div>
</x-app-layout>
