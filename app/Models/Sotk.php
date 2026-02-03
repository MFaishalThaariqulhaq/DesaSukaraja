<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sotk extends Model
{
  protected $fillable = [
    'nama', 
    'jabatan', 
    'foto', 
    'bagan', 
    'tupoksi',
    'keterangan',
    'badge_color',
    'overlay_bg_color',
    'icon_color',
    'icon_name'
  ];
}
