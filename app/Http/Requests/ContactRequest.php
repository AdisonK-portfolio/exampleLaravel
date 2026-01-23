<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        // todo: add validation
        return true;
    }

    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:36'],
            'lastName' => ['required', 'string','max:40'],
            'email' => ['required', 'email'],
            'primaryCompany_id' => ['required', 'exists:companies,id'],
        ];
    }
}
