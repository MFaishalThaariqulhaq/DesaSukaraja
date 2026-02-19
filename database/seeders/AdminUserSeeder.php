<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
  public function run()
  {
    User::updateOrCreate([
      'email' => 'admin@sukaraja.id'
    ], [
      'name' => 'Admin Desa',
      'role' => 'super_admin',
      'password' => Hash::make('admin123'),
    ]);
  }
}
