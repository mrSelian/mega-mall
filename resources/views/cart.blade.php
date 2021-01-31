<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Корзина') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @php
            echo '<pre>';
           var_dump(session('cart'));
        @endphp
  Итоговая сумма: {{$totalPrice}} RUR
        <br>
        <form action="/cart/clear" method="POST" class="form-horizontal">
            @csrf

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Очистить Корзину
                    </button>
                </div>
            </div>
        </form>



    </div>

</x-app-layout>
