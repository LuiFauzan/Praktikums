<?php

use App\Models\Praktikum;
use App\Models\RiwayatPraktikum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AslabController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PraktikumController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DaftarPraktikumController;
use App\Http\Controllers\JadwalPraktikumController;
use App\Http\Controllers\RiwayatPembayaranController;
use App\Http\Controllers\WelcomeController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/',[WelcomeController::class,'index']);
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/notifications/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

// Route Dosen 
Route::get('/dashboard/dosen',[DosenController::class,'index'])->name('dosen');
Route::get('/dashboard/dosen/{id}/edit',[DosenController::class,'index'])->name('dosen.edit');
Route::post('/dashboard/dosen',[DosenController::class,'store'])->name('dosen.store');
Route::put('/dashboard/dosen/{id}',[DosenController::class,'update'])->name('dosen.update');
Route::delete('/dashboard/dosen/{id}',[DosenController::class,'destroy'])->name('dosen.destroy');

// Route Asisten Lab
Route::get('/dashboard/aslab',[AslabController::class,'index'])->name('aslab');
Route::get('/dashboard/aslab/{id}/edit',[AslabController::class,'index'])->name('aslab.edit');
Route::post('/dashboard/aslab',[AslabController::class,'store'])->name('aslab.store');
Route::put('/dashboard/aslab/{id}',[AslabController::class,'update'])->name('aslab.update');
Route::delete('/dashboard/aslab/{id}',[AslabController::class,'destroy'])->name('aslab.destroy');

// Route Praktikum
Route::get('/dashboard/praktikum',[PraktikumController::class,'index'])->name('praktikum');
Route::get('/dashboard/praktikum/{id}/edit',[PraktikumController::class,'index'])->name('praktikum.edit');
Route::post('/dashboard/praktikum',[PraktikumController::class,'store'])->name('praktikum.store');
Route::put('/dashboard/praktikum/{id}',[PraktikumController::class,'update'])->name('praktikum.update');
Route::delete('/dashboard/praktikum/{id}',[PraktikumController::class,'destroy'])->name('praktikum.destroy');



// Route Jadwal Praktikum
Route::get('/dashboard/jadwalpraktikum',[JadwalPraktikumController::class,'index'])->name('jadwalpraktikum');
Route::get('/dashboard/jadwalpraktikum/{id}/edit',[JadwalPraktikumController::class,'index'])->name('jadwalpraktikum.edit');
Route::post('/dashboard/jadwalpraktikum',[JadwalPraktikumController::class,'store'])->name('jadwalpraktikum.store');
Route::put('/dashboard/jadwalpraktikum/{id}',[JadwalPraktikumController::class,'update'])->name('jadwalpraktikum.update');
Route::delete('/dashboard/jadwalpraktikum/{id}',[JadwalPraktikumController::class,'destroy'])->name('jadwalpraktikum.destroy');

// Route Daftar Praktikum
Route::get('/dashboard/daftarpraktikum',[DaftarPraktikumController::class,'index'])->name('daftarpraktikum');
Route::get('/dashboard/daftarpraktikum/{id}/edit',[DaftarPraktikumController::class,'index'])->name('daftarpraktikum.edit');
Route::post('/dashboard/daftarpraktikum',[DaftarPraktikumController::class,'store'])->name('daftarpraktikum.store');
Route::put('/dashboard/daftarpraktikum/{id}',[DaftarPraktikumController::class,'update'])->name('daftarpraktikum.update');
Route::delete('/dashboard/daftarpraktikum/{id}',[DaftarPraktikumController::class,'destroy'])->name('daftarpraktikum.destroy');
Route::delete('/dashboard/daftarpraktikum',[DaftarPraktikumController::class,'batchDelete'])->name('daftarpraktikum.batchDelete');

// Route Data Mahasiswa
Route::get('/dashboard/mahasiswa',[MahasiswaController::class,'index'])->name('mahasiswa');
Route::get('/dashboard/mahasiswa/{id}/edit',[MahasiswaController::class,'index'])->name('mahasiswa.edit');
Route::post('/dashboard/mahasiswa',[MahasiswaController::class,'store'])->name('mahasiswa.store');
Route::put('/dashboard/mahasiswa/{id}',[MahasiswaController::class,'update'])->name('mahasiswa.update');
Route::delete('/dashboard/mahasiswa/{id}',[MahasiswaController::class,'destroy'])->name('mahasiswa.destroy');
// Route::delete('/dashboard/mahasiswa',[MahasiswaController::class,'batchDelete'])->name('mahasiswa.batchDelete');

// Route Data Pembayaran
Route::get('/dashboard/pembayaran',[PembayaranController::class,'index'])->name('pembayaran');
Route::get('/dashboard/pembayaran/{id}/edit',[PembayaranController::class,'index'])->name('pembayaran.edit');
Route::post('/dashboard/pembayaran',[PembayaranController::class,'store'])->name('pembayaran.store');
Route::put('/dashboard/pembayaran/{id}',[PembayaranController::class,'update'])->name('pembayaran.update');
Route::delete('/dashboard/pembayaran/{id}',[PembayaranController::class,'destroy'])->name('pembayaran.destroy');
// Route::delete('/dashboard/pembayaran',[PembayaranController::class,'batchDelete'])->name('pembayaran.batchDelete');

// Route Data Rwayat Pembayaran
Route::get('/dashboard/riwayatpembayaran',[RiwayatPembayaranController::class,'index'])->name('riwayatpembayaran');
// Route::get('/dashboard/riwayatpembayaran/{id}/edit',[RiwayatPembayaranController::class,'index'])->name('riwayatpembayaran.edit');
// Route::post('/dashboard/riwayatpembayaran',[RiwayatPembayaranController::class,'store'])->name('riwayatpembayaran.store');
Route::put('/dashboard/riwayatpembayaran/{id}/sukses', [RiwayatPembayaranController::class, 'updateSukses'])->name('riwayatpembayaran.updatesukses');
Route::put('/dashboard/riwayatpembayaran/{id}/tolak', [RiwayatPembayaranController::class, 'updateTolak'])->name('riwayatpembayaran.updatetolak');
Route::delete('/dashboard/riwayatpembayaran/{id}',[RiwayatPembayaranController::class,'destroy'])->name('riwayatpembayaran.destroy');
// Route::delete('/dashboard/pembayaran',[PembayaranController::class,'batchDelete'])->name('pembayaran.batchDelete');

// Route Student 
Route::get('/dashboard/student',[StudentController::class,'index'])->name('student');
Route::get('/dashboard/pembayaran-praktikum',[StudentController::class,'pembayaran'])->name('pembayaran.praktikum');
Route::post('/dashboard/pembayaran-praktikum',[StudentController::class,'checkout'])->name('checkout');
Route::get('/dashboard/riwayat',[StudentController::class,'riwayat'])->name('riwayat');
Route::delete('/dashboard/riwayat/{id}',[StudentController::class,'destroy'])->name('riwayat.destroy');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
