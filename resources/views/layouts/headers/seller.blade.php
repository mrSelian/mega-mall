<x-slot name="header">
    <div class="flex justify-evenly ">
        <a href="{{route('seller_profile')}}"
           class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
            {{ __('Профиль Продавца') }}
        </a>
        <a href="{{route('seller_products')}}"
           class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
            {{ __('Мои Товары') }}
        </a>

        <a href="{{route('seller_orders')}}"
           class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
            {{ __('Мои Заказы') }}
        </a>
    </div>
</x-slot>
