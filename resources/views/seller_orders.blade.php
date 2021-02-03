<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-evenly ">
            <a href="{{route('seller')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Кабинет Продавца') }}
            </a>
            <a href="{{route('seller_products')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Мои Товары') }}
            </a>
            <a href="{{route('create_product')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Добавить товар') }}
            </a>
            <a href="{{route('seller_orders')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
                {{ __('Мои Заказы') }}
            </a>
        </div>
    </x-slot>


        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            Здесь будет список заказов продавца.
        </div>
</x-app-layout>
