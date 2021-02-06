<x-slot name="header">
    <div class="flex justify-evenly ">
        <a href="{{route('customer_profile')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
            {{ __('Профиль Покупателя') }}
        </a>
        <a href="{{route('customer_orders')}}" class="font-semibold hover:underline text-center text-lg text-gray-800 leading-tight">
            {{ __('Мои Заказы') }}
        </a>
    </div>
</x-slot>
