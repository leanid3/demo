<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'car_id' => 'required|exists:cars,id',
            'booking_date' => [
                'required',
                'date',
                'after:today',
                function ($attribute, $value, $fail) {
                    $conflictingOrder = Order::where('car_id', $this->car_id)
                        ->where('booking_date', $value)
                        ->whereIn('status', ['new', 'confirmed'])
                        ->exists();

                    if ($conflictingOrder) {
                        $fail('Этот автомобиль уже забронирован на выбранную дату');
                    }
                }
            ]
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => Auth::id()
        ]);
    }
}
