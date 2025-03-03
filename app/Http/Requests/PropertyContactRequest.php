<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyContactRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'min:2'],
            'name' => ['required', 'string', 'min:2'],
            'phone' => ['required', 'string', 'regex:/^(\+33|0)[1-9](\d{2}){4}/'],
            'mail' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/'],
            'content' => ['required', 'string', 'min:16']
        ];
    }

    public function messages():array
    {
        return [
            'firstname.required' => 'Champ "Prénom" requis',
            'name.required' => 'Champ "Nom" requis',
            'phone.required' => 'Champ "Téléphone" requis',
            'mail.required' => 'Champ "Email" requis',
            'content.required' => 'Champ "Message" requis',
            'phone.regex' => 'Format invalide',
            'mail.regex' => 'Format invalide',
            'content.min' => '16 caractères minimum'
        ];
    }
}
