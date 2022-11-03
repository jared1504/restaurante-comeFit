<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierStoreRequest extends FormRequest
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
            'company_name' => ['required', 'string', 'max:100'],
            'contact_name' => ['required', 'string', 'max:100'],
            'contact_title' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string'],
            'suburb' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'zip' => ['required', 'integer'],
            'phone' => ['required', 'string', 'max:20'],
            'website' => ['required', 'string'],
        ];
    }
}
