<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengaduan extends Model
{
  protected $fillable = ['nama', 'email', 'telepon', 'alamat', 'kategori', 'judul', 'isi', 'file_path', 'status', 'urgency', 'lat', 'lng', 'internal_notes', 'handled_by', 'tracking_number', 'admin_notes'];

  protected $casts = [
    'lat' => 'decimal:7',
    'lng' => 'decimal:7',
  ];

  public function progressUpdates(): HasMany
  {
    return $this->hasMany(PengaduanProgress::class);
  }
}
