<div class="bg-white rounded-lg shadow-md p-6" data-car-id="{{ $car->id }}">
    <div class="mb-4">
        @if($car->image)
            <img src="{{ asset('storage/'.$car->image) }}" alt="{{ $car->name }}" class="w-full h-48 object-cover rounded">
        @endif
    </div>
    <h3 class="text-xl font-semibold">{{ $car->name }} {{ $car->model }}</h3>
    <p class="text-gray-600 mt-2">{{ $car->description }}</p>

    <div class="mt-4 flex space-x-2">
        <a href="{{ route('product.edit', $car) }}" class="btn-edit">Редактировать</a>
        <button class="btn-delete" onclick="deleteCar({{ $car->id }})">Удалить</button>
    </div>
</div>
