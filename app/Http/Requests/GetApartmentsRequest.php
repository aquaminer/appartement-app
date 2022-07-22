<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetApartmentsRequest extends FormRequest
{
    public function rules(): array{
        return [
            'price' => 'array|min:2|max:3',
            'price.*' => 'integer',
            'name' => 'string',
            'bedrooms' => 'integer',
            'bathrooms' => 'integer',
            'storeys' => 'integer',
            'garages' => 'integer',
        ];
    }
}
