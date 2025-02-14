<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Заявки') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Блок для уведомлений -->
                    <div id="flash-message" class="opacity-0 transition-opacity duration-300 rounded-full py-2 text-center text-white bg-green-400 mb-4">
                        Сообщение появится здесь
                    </div>

                    @if(auth()->user()->is_admin)
                        <!-- Таблица для администратора -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ФИО</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Автомобиль</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->booking_date }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->car->name }} {{ $order->car->model }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <select class="form-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="update-status" data-order-id="{{ $order->id }}">
                                                <option value="new" {{ $order->status === 'new' ? 'selected' : '' }}>Новое</option>
                                                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Подтверждено</option>
                                                <option value="rejected" {{ $order->status === 'rejected' ? 'selected' : '' }}>Отклонено</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Карточки для пользователя -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($orders as $order)
                                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                                    <div class="p-6">
                                        <h5 class="text-lg font-semibold text-gray-900"><strong>Авто:</strong> {{ $order->car->name }} {{ $order->car->model }}</h5>
                                        <p class="mt-2 text-gray-600"><strong>Дата:</strong> {{ $order->booking_date }}</p>
                                        <p class="mt-2">
                                            <strong>Статус:</strong>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                {{ $order->status === 'new' ? 'bg-blue-100 text-blue-800' :
                                                   ($order->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $order->status }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Пагинация -->
                        {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/page/order/index.js')
</x-app-layout>
