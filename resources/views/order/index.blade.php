<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Заявки') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    @if(session('message'))
                        <div class="alert alert-success bg-green-400 rounded-full py-2 text-center alert-dismissible fade show" role="alert">
                            {{session('message')}}

                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-success bg-red-400 rounded-full py-2 text-center alert-dismissible fade show" role="alert">
                            {{session('error')}}
                        </div>
                    @endif
                    @if(auth()->user()->is_admin)
                        <!-- Таблица для администратора -->
                        <div class="table-responsive ">
                            <table class="table table-bordered table-hover w-full">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">ФИО</th>
                                    <th scope="col">Телефон</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Дата</th>
                                    <th scope="col">Автомобиль</th>
                                    <th scope="col">Статус</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->user->phone }}</td>
                                        <td>{{ $order->user->email }}</td>
                                        <td>{{ $order->booking_date }}</td>
                                        <td>{{ $order->car->name }} {{ $order->car->model }}</td>
                                        <td>
                                            <select class="form-select form-select-sm" id="update-status" data-order-id="{{ $order->id }}">
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
                        <div class="row">
                            @foreach($orders as $order)
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title"><strong>Авто:</strong> {{ $order->car->name }} {{ $order->car->model }}</h5>
                                            <p class="card-text"><strong>Дата:</strong> {{ $order->booking_date }}</p>
                                            <p class="card-text">
                                                <strong>Статус:</strong>
                                                <span class="badge
                                                    {{ $order->status === 'new' ? 'bg-primary' :
                                                       ($order->status === 'confirmed' ? 'bg-success' : 'bg-danger') }}">
                                                    {{ $order->status }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Пагинация -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


