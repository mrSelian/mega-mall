<x-slot name="header">
    <div class="flex justify-evenly ">
        <x-jet-nav-link href="{{ route('seller_profile') }}" :active="request()->routeIs('seller_profile')">
            {{ __('Профиль продавца') }}
        </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('seller_products') }}" :active="request()->routeIs('seller_products')">
            {{ __('Мои товары') }}
        </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('seller_orders') }}" :active="request()->routeIs('seller_orders')">
            {{ __('Мои продажи') }}
        </x-jet-nav-link>

    </div>
</x-slot>
