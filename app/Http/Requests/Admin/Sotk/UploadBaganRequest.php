<?php

namespace App\Http\Requests\Admin\Sotk;

use Illuminate\Foundation\Http\FormRequest;

class UploadBaganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bagan' => ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
        ];
    }
}
