<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\HTTP;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController;

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

// Route::get('/home', function () {
//     $kategori = HTTP::get('http://laravelsso.test/api/v1/kategori');
//     return json_decode($kategori->getBody());
// });

Route::get('/test', function() {
    return view('test', ['pesan' => 'Ini adalah pesan yang ditampilkan dari variable dari route']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Kategori
    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
    Route::post('/admin/kategori/simpan', [KategoriController::class, 'store'])->name('admin.simpan_kategori');
    Route::get('/admin/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('admin.edit_kategori');
    Route::patch('/admin/kategori/update/{id}', [KategoriController::class, 'update'])->name('admin.update_kategori');
    Route::delete('/admin/kategori/hapus/{id}', [KategoriController::class, 'destroy'])->name('admin.hapus_kategori');

    // Produk
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.produk');
    Route::get('/admin/produk/tambah', [ProdukController::class, 'create'])->middleware('can:isAdmin')->name('admin.tambah_produk');
    Route::post('/admin/produk/simpan', [ProdukController::class, 'store'])->name('admin.simpan_produk');
    Route::get('/admin/produk/edit/{id}', [ProdukController::class, 'edit'])->name('admin.edit_produk');
    Route::patch('/admin/produk/update/{id}', [ProdukController::class, 'update'])->name('admin.update_produk');
    Route::delete('/admin/produk/hapus/{id}', [ProdukController::class, 'destroy'])->name('admin.hapus_produk');
});