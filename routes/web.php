<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\HomeController;
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
Route::get('/pemerintahan', function () {
    $sotks = \App\Models\Sotk::whereNull('bagan')->orderBy('jabatan')->get();
    $baganConfig = @json_decode(file_get_contents(config_path('bagan_sotk.json')), true);
    $baganSotk = $baganConfig['bagan'] ?? null;
    return view('public.sotk.pemerintahan', compact('sotks', 'baganSotk'));
})->name('pemerintahan');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{id}', [GaleriController::class, 'detail'])->name('galeri.detail');
Route::get('/berita', [HomeController::class, 'beritaIndex'])->name('berita.index');
Route::get('/infografis', [InfografisController::class, 'index'])->name('infografis.index');
Route::get('/sotk', [SotkController::class, 'index'])->name('sotk.index');
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->middleware('throttle:5,1')->name('pengaduan.store');


// == RUTE ADMIN ==
Route::prefix('admin')->group(function () {

    // Rute untuk menampilkan halaman login
    Route::get('login', function () {
        return view('admin.login');
    })->name('admin.login');

    // Rute untuk memproses login
    Route::post('login', function (Request $request) {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }
        // Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors(['email' => 'Email atau password salah.']);
    })->name('admin.login.submit'); // Ini adalah penutup untuk fungsi Route::post

    // Rute untuk logout
    Route::post('logout', function () {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    })->name('admin.logout');

    Route::get('dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('berita', BeritaController::class)->except(['show'])->names('admin.berita');
    Route::resource('galeri', AdminGaleriController::class)->names('admin.galeri');
    Route::resource('galeri.foto', App\Http\Controllers\Admin\FotoGaleriController::class)->shallow()->names('admin.galeri.foto');
    Route::resource('infografis', App\Http\Controllers\PendudukController::class)
        ->names('admin.infografis')
        ->parameters(['infografis' => 'penduduk']);
    //Route::resource('penduduk', App\Http\Controllers\PendudukController::class)->names('admin.penduduk');
    Route::resource('sotk', AdminSotkController::class)->names('admin.sotk');
    Route::get('admin/sotk/bagan', [AdminSotkController::class, 'baganForm'])->name('admin.sotk.bagan');
    Route::post('admin/sotk/bagan', [AdminSotkController::class, 'baganUpload'])->name('admin.sotk.bagan.upload');
    Route::resource('pengaduan', AdminPengaduanController::class)->names('admin.pengaduan');
    Route::resource('profil', App\Http\Controllers\Admin\ProfilDesaController::class)->names('admin.profil');
    Route::post('profil/tambah-sejarah', [App\Http\Controllers\Admin\ProfilDesaController::class, 'tambahSejarah'])->name('admin.profil.tambahSejarah');
    Route::delete('profil/hapus-sejarah/{id}', [App\Http\Controllers\Admin\ProfilDesaController::class, 'hapusSejarah'])->name('admin.profil.hapusSejarah');
    Route::get('/berita/{slug}', [App\Http\Controllers\HomeController::class, 'beritaDetail'])->name('berita.detail');
}); // Ini adalah penutup untuk Route::prefix('admin')->group
