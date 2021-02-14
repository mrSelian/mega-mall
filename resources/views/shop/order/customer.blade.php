<x-app-layout>
    <x-slot name="header">
        <x-jet-nav-link href="{{ route('customer_orders') }}" :active="request()->routeIs('customer_orders')">
            {{ __('К истории покупок') }}
        </x-jet-nav-link>
        @section('page-title')
            Заказ
        @endsection
    </x-slot>
    <div class="p-6 max-w-6xl mx-auto">
    <pre>
        @php
            var_dump($order);
        @endphp

    </div>

</x-app-layout>
