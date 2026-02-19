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
            'bagan' => ['required_without:remove_bagan', 'nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'remove_bagan' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'bagan.required_without' => 'Silakan pilih gambar bagan atau centang hapus bagan.',
        ];
    }
}
