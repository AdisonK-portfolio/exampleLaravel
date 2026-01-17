<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize(): bool {

        return false;
    }

    public function rules(): array {

        return [
            'name' => ['required', 'string','max:40'],
            'description' => ['required', 'string','min:5','max:1000'],
        ];
    }
}
