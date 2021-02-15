<x-app-layout>
    @include('layouts.headers.seller')
    @section('page-title')
        Добавление информации продавца
    @endsection
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">





        <div class="antialiased text-gray-900">

            <form action="{{route('update_seller_info')}}" method="POST" class="form mt-4">
                @method('PATCH')
                <div class="mx-4 card bg-white max-w-md p-10 md:rounded-lg my-12 mx-auto">
                    <label for="" class=" control-label font-bold text-center"><h1>Изменить информацию</h1></label>

                    @csrf

                    <div class="flex flex-col text-sm">
                        <label for="name" class="font-bold mt-4 mb-2">Название магазина*</label>
                        <input name="name" id="name" class="appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" value="{{$info->name}}" placeholder="Так будут видеть название покупатели">
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="main_photo" class="font-bold mt-4 mb-2">Основное фото (URL)</label>
                        <input name="main_photo" id="main_photo" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" value="{{$info->main_photo}}" placeholder="Основное фото магазина ">
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="info" class="font-bold mt-4 mb-2">Информация для покупателей</label>
                        <textarea name="info" id="info" class="appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                                   placeholder="Дополнительная информация">{{$info->info}}</textarea>
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="phone" class="font-bold mt-4 mb-2">Номер телефона</label>
                        <input name="phone" id="phone" class="appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" value="{{$info->phone}}" placeholder="Введите номер телефона">
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="email" class="font-bold mt-4 mb-2">E-mail*</label>
                        <input name="email" id="email" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" value="{{$info->email}}" placeholder="Адрес электронной почты">
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="delivery_terms" class="font-bold mt-4 mb-2">Условия доставки*</label>
                        <textarea name="delivery_terms" id="delivery_terms" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                                   placeholder="Опишите условия и цену доставки.">{{$info->delivery_terms}}</textarea>
                    </div>

                    <div class="flex flex-col text-sm">
                        <label for="additional_contact" class="font-bold mt-4 mb-2">Дополнительный контакт</label>
                        <input name="additional_contact" id="additional_contact" class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500"
                               type="text" value="{{$info->additional_contact}}" placeholder="Наименование и контакт (пример Telegram: ник)">
                    </div>

                    <div class="mt-4 mb-2"><b>*</b> - обязательное поле</div>


                    @include('layouts.errors')


                    <div class="submit">
                        <button type="submit"
                                class=" w-full bg-indigo-500 text-white px-4 py-2 mt-6 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
                            Изменить
                        </button>
                    </div>
            </form>
        </div>

    </div>

    </div>
</x-app-layout>