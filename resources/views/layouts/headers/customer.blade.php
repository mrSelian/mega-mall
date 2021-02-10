<x-slot name="header">
    <div class="flex justify-evenly ">
            <x-jet-nav-link href="{{ route('customer_profile') }}" :active="request()->routeIs('customer_profile')">
                {{ __('Профиль покупателя') }}
            </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('customer_orders') }}" :active="request()->routeIs('customer_orders')">
            {{ __('Мои покупки') }}
        </x-jet-nav-link>
    </div>
</x-slot>
