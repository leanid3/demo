<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Товары') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div id="flash-message" class="hidden opacity-0 transition-opacity duration-300 rounded-lg p-4 mb-4"></div>

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Управление автомобилями</h1>
            <a href="{{ route('product.create') }}" class="btn-primary">Добавить новый</a>
        </div>

        <div id="cars-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($cars as $car)
                @include('product.show', ['car' => $car])
            @endforeach
        </div>
    </div>

</x-app-layout>
