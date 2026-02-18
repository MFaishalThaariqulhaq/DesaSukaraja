<?php

namespace App\Http\Requests\Pengaduan;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaduanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['nullable', 'string', 'max:191'],
            'email' => ['nullable', 'email', 'max:191'],
            'telepon' => ['nullable', 'string', 'max:50'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'judul' => ['nullable', 'string', 'max:191'],
            'isi' => ['required', 'string'],
            'lampiran' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp,pdf,mp4', 'max:5120'],
            'g-recaptcha-response' => ['required', 'string'],
        ];
    }
}
