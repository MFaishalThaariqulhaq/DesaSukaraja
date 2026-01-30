<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoGaleri extends Model
{
  protected $fillable = ['galeri_id', 'path', 'caption'];
  public function galeri()
  {
    return $this->belongsTo(Galeri::class);
  }
}
