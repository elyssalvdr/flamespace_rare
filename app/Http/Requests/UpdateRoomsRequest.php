<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:50|unique:rooms,code',
            'name' => 'required|string|max:250',
            'building' => 'required|integer|min:1|max:10000',
            'capacity' => 'required|integer|min:1|max:10000',
            'description' => 'nullable|string'
        ];
    }
}