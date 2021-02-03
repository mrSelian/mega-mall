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
Позже здесь будет кабинет покупателя. Изменение адреса, дополнительные контакты.
    </div>
</x-app-layout>
