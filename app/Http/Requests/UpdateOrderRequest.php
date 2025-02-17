<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'car_id' => ['required', 'exists:cars,id'],
            'booking_id' => [
                'required',
                'exists:bookings,id',
                'date',
                'after:today',
                'unique:orders,booking_date,NULL,id,status,new'
            ],
        ];
    }
    public function prepareForValidation(): void
    {
        [
            'user_id' => Auth::id()
        ];
    }
}
