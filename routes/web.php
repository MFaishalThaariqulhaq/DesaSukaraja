<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\InfografisController;
use App\Http\Controllers\SotkController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\InfografisController as AdminInfografisController;
use App\Http\Controllers\Admin\SotkController as AdminSotkController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;

/*
|--------------------------------------------------------------------------
| Rute Web
|--------------------------------------------------------------------------
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda.
|
*/

// == RUTE PUBLIK ==
// Rute yang bisa diakses oleh semua pengunjung.
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
// Route Pemerintahan
// Route SOTK (Struktur Organisasi dan Tata Kerja)
Route::get('/sotk', [SotkController::class, 'index'])->name('sotk.index');
Route::get('/sotk/detail', [SotkController::class, 'detail'])->name('sotk.detail');
Route::get('/sotk/struktur', [SotkController::class, 'struktur'])->name('sotk.struktur');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/berita', [HomeController::class, 'beritaIndex'])->name('berita.index');
Route::get('/berita/{slug}', [HomeController::class, 'beritaDetail'])->name('berita.detail');
Route::get('/infografis', [InfografisController::class, 'index'])->name('infografis.index');
Route::get('/infografis/{dusun}', [InfografisController::class, 'detail'])->name('infografis.detail');
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->middleware('throttle:5,1')->name('pengaduan.store');
Route::get('/pengaduan/status', [PengaduanController::class, 'checkStatus'])->name('pengaduan.status');
Route::get('/pengaduan/list', [PengaduanController::class, 'listPengaduan'])->name('pengaduan.list');


// == RUTE ADMIN ==
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');

    Route::middleware('admin.session')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('berita', BeritaController::class)->except(['show'])->names('berita');
        Route::resource('galeri', AdminGaleriController::class)->names('galeri');
        Route::resource('infografis', AdminInfografisController::class)->names('infografis')->parameters(['infografis' => 'penduduk']);
        Route::resource('sotk', AdminSotkController::class)->names('sotk');
        Route::get('sotk/bagan', [AdminSotkController::class, 'baganForm'])->name('sotk.bagan');
        Route::post('sotk/bagan', [AdminSotkController::class, 'baganUpload'])->name('sotk.bagan.upload');
        Route::delete('pengaduan/{pengaduan}/progress/{progress}', [AdminPengaduanController::class, 'destroyProgress'])->name('pengaduan.progress.destroy');
        Route::resource('pengaduan', AdminPengaduanController::class)->names('pengaduan');
        Route::resource('profil', App\Http\Controllers\Admin\ProfilDesaController::class)->names('profil');
        Route::post('profil/tambah-sejarah', [App\Http\Controllers\Admin\ProfilDesaController::class, 'tambahSejarah'])->name('profil.tambahSejarah');
        Route::delete('profil/hapus-sejarah/{id}', [App\Http\Controllers\Admin\ProfilDesaController::class, 'hapusSejarah'])->name('profil.hapusSejarah');
    });
});
