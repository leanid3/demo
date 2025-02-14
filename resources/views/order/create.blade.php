<x-app-layout>
    <!-- Заголовок -->
    <h1 class="text-center text-2xl font-bold mb-6 mt-8">Создать заявку</h1>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Блок для уведомлений -->
        <div id="flash-message" class="opacity-0 transition-opacity duration-300 rounded-full py-2 text-center text-white bg-green-400 mb-4">
            Сообщение появится здесь
        </div>

        <form id="create-order-form" action="{{route('orders.store')}}" class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf

            <!-- Выбор автомобиля -->
            <div class="mb-6">
                <label for="car_id" class="block text-sm font-medium text-gray-700">Автомобиль</label>
                <select name="car_id" id="car_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}">
                            {{ $car->name }} {{ $car->model }} - {{ $car->description }}
                        </option>
                    @endforeach
                </select>
                <p id="car_id_error" class="mt-2 text-sm text-red-600 hidden"></p>
            </div>

            <!-- Дата бронирования -->
            <div class="mb-6">
                <label for="booking_date" class="block text-sm font-medium text-gray-700">Дата бронирования</label>
                <input
                    id="booking_date"
                    type="date"
                    name="booking_date"
                    value="{{ old('booking_date') }}"
                    min="{{ now()->addDay()->format('Y-m-d') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required
                />
                <p id="booking_date_error" class="mt-2 text-sm text-red-600 hidden"></p>
            </div>

            <!-- Кнопка отправки -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Создать заявку
                </button>
            </div>
        </form>
    </div>

    @vite('resources/js/page/order/create.js')
</x-app-layout>
