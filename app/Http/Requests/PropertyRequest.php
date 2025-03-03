<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class PropertyRequest extends FormRequest
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
            'title' => ['required', 'min:4'],
            'surface' => ['required'],
            'price' => ['required'],
            'description' => ['required', 'min:8'],
            'room' => ['required', 'min:1'],
            'bedroom' => ['required'],
            'floor' => ['required'],
            'address' => ['required', 'min:4'],
            'town' => ['required', 'min:4'],
            'zip' => ['required'],
            'sell' => ['required', 'boolean'],
            'images' => ['array'],
            'images.*' => [File::types(['jpg', 'jpeg', 'png', 'webp']), 'max:2000'],
            'options' => ['required', 'array']
        ];
    }
}
