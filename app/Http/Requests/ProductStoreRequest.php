<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'price' => ['required', 'numeric', 'between:-99999.99,99999.99'],
            'stock' => ['required', 'numeric', 'between:-99999.99,99999.99'],
            'slug' => ['required', 'string'],
            'presentation' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'url_photo' => ['required', 'string'],
            'content' => ['required', 'numeric', 'between:-99999.99,99999.99'],
        ];
    }
}
