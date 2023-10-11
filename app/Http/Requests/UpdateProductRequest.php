<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

public function rules(): array
{
    return [
        'name' => ['sometimes', 'required'],
        'description' => ['nullable'],
        'price' => ['sometimes', 'required'],
        'slug' => ['sometimes', 'required'],
    ];
}
}
