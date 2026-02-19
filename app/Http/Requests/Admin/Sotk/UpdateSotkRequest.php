<?php

namespace App\Http\Requests\Admin\Sotk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSotkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string'],
            'jabatan' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'remove_foto' => ['nullable', 'boolean'],
            'keterangan' => ['nullable', 'string', 'max:255'],
            'tupoksi' => ['nullable', 'string'],
            'badge_color' => ['nullable', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'],
            'overlay_bg_color' => ['nullable', 'string'],
            'icon_color' => ['nullable', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'],
            'icon_name' => ['nullable', 'string'],
        ];
    }
}
