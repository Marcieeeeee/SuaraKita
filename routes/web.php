<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MasyarakatController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\TanggapanController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('suarakita.index');

// Masyarakat
Route::middleware(['isMasyarakat'])->group(function() {
    //laporan
    Route::get('/laporan/{siapa?}', [UserController::class, 'laporan'])->name('suarakita.laporan');
    
    //logout
    Route::get('/logout', [UserController::class, 'logout'])->name('suarakita.logout');
    
    //Kirim Pengaduan
    Route::post('/store', [UserController::class, 'storePengaduan'])->name('suarakita.store');
});

Route::middleware(['guest'])->group(function() {
    //login
    Route::post('/login/auth', [UserController::class, 'login'])->name('suarakita.login');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');

    //register
    Route::get('/register', [UserController::class, 'formRegister'])->name('suarakita.formRegister');
    Route::post('/register/auth', [UserController::class, 'register'])->name('suarakita.register');
});

//Admin
Route::prefix('admin')->group(function () {
    
    Route::middleware(['isPetugas'])->group(function(){
        //dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');
        
        //pengaduan
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id_pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        
        //tanggapan
        Route::post('/tanggapan/createOrUpdate/{id_pengaduan}', [TanggapanController::class, 'createOrUpdate'])->name('tanggapan.createOrUpdate');
        
        //logout
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });

    //login
    Route::get('/admin', [AdminController::class, 'formLogin'])->name('admin.formLogin');
    Route::post('/login', [AdminController::class, 'loginRequest'])->name('admin.login');
    
    //dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');
        
    //laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::match(['post', 'patch'], '/getlaporan', [LaporanController::class, 'getLaporan'])->name('laporan.getLaporan');
    Route::get('laporan/cetak/{from}/{to}', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetakLaporan');

    //petugas
    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
    Route::get('/petugas/tambah', [PetugasController::class, 'tambah'])->name('petugas.formTambah');
    Route::post('/petugas/register', [PetugasController::class, 'register'])->name('petugas.register');
    Route::get('/petugas/edit/{id_petugas}', [PetugasController::class, 'edit'])->name('petugas.formEdit');
    Route::post('/petugas/update/{id_petugas}', [PetugasController::class, 'update'])->name('petugas.update');
    Route::delete('/petugas/delete/{id_petugas}', [PetugasController::class, 'destroy'])->name('petugas.destroy');
    
    //pengaduan
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{id_pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    
    //tanggapan
    Route::post('/tanggapan/createOrUpdate/{id_pengaduan}', [TanggapanController::class, 'createOrUpdate'])->name('tanggapan.createOrUpdate');
    
    //logout
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    //masyarakat
    Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('masyarakat.index');
    Route::get('/masyarakat/{id}', [MasyarakatController::class, 'show'])->name('masyarakat.show');
    
});