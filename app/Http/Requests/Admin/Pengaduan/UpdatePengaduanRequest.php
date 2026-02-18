<?php

namespace App\Http\Requests\Admin\Pengaduan;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengaduanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:submitted,pending,in_progress,resolved,rejected'],
            'admin_notes' => ['nullable', 'string'],
            'progress_note' => ['nullable', 'string', 'max:2000'],
            'progress_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'publish_progress' => ['nullable', 'boolean'],
        ];
    }
}
