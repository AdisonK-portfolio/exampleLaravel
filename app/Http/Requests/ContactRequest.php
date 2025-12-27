<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:36'],
            'lastName' => ['required', 'string','max:40'],
            'email' => ['required', 'email'],
            'company_id' => ['nullable', 'exists:companies,id'],
        ];
    }
}
