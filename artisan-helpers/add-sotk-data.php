<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sotks = [
    ['nama' => 'Acep Sukmana', 'jabatan' => 'Kepala Desa', 'tupoksi' => 'Memimpin pemerintahan desa dan melaksanakan kebijakan pembangunan.'],
    ['nama' => 'Endang Sobali', 'jabatan' => 'Sekretaris Desa', 'tupoksi' => 'Membantu kepala desa dalam administrasi dan perencanaan program.'],
    ['nama' => 'Rio Yogaswara', 'jabatan' => 'Kaur Keuangan', 'tupoksi' => 'Mengelola keuangan desa dan pelaporan pertanggungjawaban.'],
    ['nama' => 'Siti Aminah', 'jabatan' => 'Kaur Tata Usaha', 'tupoksi' => 'Mengelola tata usaha desa dan dokumen administrasi.'],
    ['nama' => 'Budi Santoso', 'jabatan' => 'Kasi Pemerintahan', 'tupoksi' => 'Menangani bidang pemerintahan dan ketentraman.'],
    ['nama' => 'Linda Wati', 'jabatan' => 'Kasi Pembangunan', 'tupoksi' => 'Mengelola program pembangunan infrastruktur desa.'],
];

foreach($sotks as $data) {
    \App\Models\Sotk::create($data);
}

echo "Data SOTK berhasil ditambahkan!\n";
$data = \App\Models\Sotk::whereNull('bagan')->get(['id', 'nama', 'jabatan']);
foreach($data as $item) {
    echo "ID: {$item->id}, Nama: {$item->nama}, Jabatan: {$item->jabatan}\n";
}
