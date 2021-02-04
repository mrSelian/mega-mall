<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-evenly ">
            <a href="{{route('customer')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Кабинет Покупателя') }}
            </a>
            <a href="{{route('customer_orders')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Мои Заказы') }}
            </a>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if($address == null)
            <div>Вы ещё не добавили адрес.</div>
        <br>
            <a href="{{route('create_address')}}" class=" bg-indigo-500 text-white px-4 py-2 border rounded-md  hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Добавить</a>
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

            @php
               // var_dump($address);
            @endphp

            <a href="{{route('create_address')}}" class=" bg-indigo-500 text-white px-4 py-2 border rounded-md  hover:bg-white hover:border-indigo-500 hover:text-black font-semibold">Изменить</a>

        @endif
    </div>
</x-app-layout>
