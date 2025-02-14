<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Обновить товар') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div id="flash-message" class="hidden opacity-0 transition-opacity duration-300 rounded-lg p-4 mb-4"></div>

        <h1 class="text-2xl font-bold mb-6">Редактировать автомобиль</h1>
        <form action="{{ route('product.update', $car) }}" method="POST" enctype="multipart/form-data" class="car-form max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Название -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Название</label>
                <input type="text" name="name" id="name" value="{{ $car->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                <p id="name_error" class="mt-2 text-sm text-red-600 hidden"></p>
            </div>

            <!-- Модель -->
            <div class="mb-6">
                <label for="model" class="block text-sm font-medium text-gray-700">Модель</label>
                <input type="text" name="model" id="model" value="{{ $car->model }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                <p id="model_error" class="mt-2 text-sm text-red-600 hidden"></p>
            </div>

            <!-- Описание -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $car->description }}</textarea>
                <p id="description_error" class="mt-2 text-sm text-red-600 hidden"></p>
            </div>

            <!-- Изображение -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700">Изображение</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                @if($car->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/'.$car->image) }}" alt="{{ $car->name }}" class="w-48 h-32 object-cover rounded">
                    </div>
                @endif
                <p id="image_error" class="mt-2 text-sm text-red-600 hidden"></p>
            </div>

            <!-- Кнопки -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('product.index') }}" class="btn-secondary">Отмена</a>
                <button type="submit" class="btn-primary">Обновить</button>
            </div>
        </form>
    </div>
</x-app-layout>
