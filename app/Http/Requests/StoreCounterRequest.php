<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCounterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'date' => 'nullable|date',
            'item_type' => 'required|string|max:45',
            'item' => 'required|string|max:45',
            'extra_name' => 'nullable|string|max:45',
            'extra_data' => 'nullable|string|max:250',
        ];
    }

    public function attributes()
    {
        return [
            'date' => 'fecha',
            'item_type' => 'tipo de elemento',
            'item' => 'elemento',
            'extra_name' => 'campo extra',
            'extra_data' => 'valor campo extra',
        ];
    }
}
