<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoneNumber extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'phone_number' => 'required|min:6',
            'primary' => 'nullable|boolean',
        ];
    }
}
