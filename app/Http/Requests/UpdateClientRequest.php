<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'rib' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'avatar' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], // the max is in kilobytes (2048KB = 2MB)
        ];
    }
}
