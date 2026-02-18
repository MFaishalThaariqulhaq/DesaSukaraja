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
        ];
    }
}
