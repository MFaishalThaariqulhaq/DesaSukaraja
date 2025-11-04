<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
  protected $fillable = ['nama', 'email', 'telepon', 'alamat', 'kategori', 'judul', 'isi', 'file_path', 'status', 'urgency', 'lat', 'lng', 'internal_notes', 'handled_by'];

  protected $casts = [
    'lat' => 'decimal:7',
    'lng' => 'decimal:7',
  ];
}
