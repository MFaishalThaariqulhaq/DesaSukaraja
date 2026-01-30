<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'deskripsi_profil',
        'motto_profil',
        'visi',
        'misi',
        'nama_kades',
        'periode_kades',
        'foto_kades',
        'sambutan_kades',
        'ttd_kades',
        'struktur_organisasi',
        'judul_sambutan_kades',
        'isi_sambutan_kades'
    ];

    public function sejarah()
    {
        return $this->hasMany(SejarahDesa::class, 'profil_desa_id');
    }
}
