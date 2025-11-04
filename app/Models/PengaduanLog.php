<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaduanLog extends Model
{
  protected $fillable = ['pengaduan_id', 'action', 'meta'];

  protected $casts = [
    'meta' => 'array',
  ];
}
