<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'total' => ['required', 'numeric'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
