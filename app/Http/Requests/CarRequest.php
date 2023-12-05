<?php

namespace App\Http\Requests;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:100',
            'location' => 'required|string|max:255',
            'year' => 'required|numeric|min:1990',
            'mileage' => 'required|numeric|min:1',
            'registration' =>'required|string|max:9',
            'bodyType' => 'required|in:' . implode(',', Car::$bodyType),
            'state' => 'required|in:' . implode(',', Car::$state)
        ];
    }
}