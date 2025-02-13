<x-app-layout>
    <!-- Заголовок -->
    <h1 class="text-center text-2xl font-bold mb-6">Создать заявку</h1>
    <div class="container mx-auto">

        <form method="POST" action="{{ route('orders.store') }}" class="max-w-2xl mx-auto">
            @csrf

            <!-- Выбор автомобиля -->
            <div class="mb-4">
                <x-input-label for="car_id" :value="__('Автомобиль')" />
                <select name="car_id" id="car_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}">
                            {{ $car->name }} {{ $car->model }} - {{ $car->description }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('car_id')" class="mt-2" />
            </div>

            <!-- Дата бронирования -->
            <div class="mb-4">
                <x-input-label for="booking_date" :value="__('Дата бронирования')" />
                <x-text-input
                    id="booking_date"
                    class="block mt-1 w-full"
                    type="date"
                    name="booking_date"
                    :value="old('booking_date')"
                    min="{{ now()->addDay()->format('Y-m-d') }}"
                    required />
                <x-input-error :messages="$errors->get('booking_date')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-6">
                <x-primary-button>
                    {{ __('Создать заявку') }}
                </x-primary-button>
            </div>
        </form>
    </div>

</x-app-layout>
