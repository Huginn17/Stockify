<?php

use App\Exports\ProdukExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManajerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockKeluarController;
use App\Http\Controllers\StockMasukController;
use App\Http\Controllers\StockOpnameController;
use App\Imports\ProdukImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('manual-auth.login');
// });
Route::get('/', function () {
    return view('manual-auth.login');
});

Route::get('/home', function () {
    return view('admin.dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login-proses', [AuthController::class, 'loginproses'])->name('loginproses');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//Admin 
Route::prefix('admin')->middleware('auth')->middleware('userAkses:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    //PRODUK
    Route:
    Route::get('/produk', [AdminController::class, 'produk'])->name('admin.produk');
    Route::get('/produk/create', [AdminController::class, 'create_produk'])->name('admin.produk.create');
    Route::post('/produk/store', [AdminController::class, 'store_produk'])->name('admin.produk.store');
    Route::get('/produk/{produk}', [AdminController::class, 'show_produk'])->name('admin.produk.show');
    Route::get('/produk/{produk}/edit', [AdminController::class, 'edit_produk'])->name('admin.produk.edit');
    Route::put('/produk/{produk}', [AdminController::class, 'update_produk'])->name('admin.produk.update');
    Route::delete('/produk/{produk}', [AdminController::class, 'destroy_produk'])->name('admin.produk.destroy');


    //KATEGORI  
    Route::get('/kategori', [AdminController::class, 'kategori'])->name('admin.kategori.index');
    Route::get('/kategori/create', [AdminController::class, 'create_kategori'])->name('admin.kategori.create');
    Route::post('/kategori/store', [AdminController::class, 'store_kategori'])->name('admin.kategori.store');
    Route::get('/kategori/{kategori}', [AdminController::class, 'show_kategori'])->name('admin.kategori.show');
    Route::get('/kategori/{kategori}/edit', [AdminController::class, 'edit_kategori'])->name('admin.kategori.edit');
    Route::put('/kategori/update/{kategori}', [AdminController::class, 'update_kategori'])->name('admin.kategori.update');
    Route::delete('/kategori/{kategori}', [AdminController::class, 'destroy_kategori'])->name('admin.kategori.destroy');



    //Supplier
    Route::get('/supplier', [AdminController::class, 'supplier'])->name('admin.supplier.index');
    Route::get('/supplier/create', [AdminController::class, 'create_supplier'])->name('admin.supplier.create');
    Route::post('/supplier/store', [AdminController::class, 'store_supplier'])->name('admin.supplier.store');
    Route::get('/supplier/{supplier}', [AdminController::class, 'show_supplier'])->name('admin.supplier.show');
    Route::get('/supplier/{supplier}/edit', [AdminController::class, 'edit_supplier'])->name('admin.supplier.edit');
    Route::put('/supplier/update/{supplier}', [AdminController::class, 'update_supplier'])->name('admin.supplier.update');
    Route::delete('/supplier/{supplier}', [AdminController::class, 'destroy_supplier'])->name('admin.supplier.destroy');



    //Attribut
    Route::get('/attribut', [AdminController::class, 'attribut'])->name('admin.attribut.index');
    Route::get('/attribut/create', [AdminController::class, 'create_attribut'])->name('admin.attribut.create');
    Route::post('/attribut/store', [AdminController::class, 'store_attribut'])->name('admin.attribut.store');
    Route::get('/attribut/{attribut}', [AdminController::class, 'show_attribut'])->name('admin.attribut.show');
    Route::get('/attribut/{attribut}/edit', [AdminController::class, 'edit_attribut'])->name('admin.attribut.edit');
    Route::put('/attribut/update/{attribut}', [AdminController::class, 'update_attribut'])->name('admin.attribut.update');
    Route::delete('/attribut/{attribut}', [AdminController::class, 'destroy_attribut'])->name('admin.attribut.destroy');



    //Pengguna
    Route::get('/pengguna', [AdminController::class, 'pengguna'])->name('admin.pengguna.index');
    Route::get('/pengguna/create', [AdminController::class, 'create_pengguna'])->name('admin.pengguna.create');
    Route::post('/pengguna/store', [AdminController::class, 'store_pengguna'])->name('admin.pengguna.store');
    Route::get('/pengguna/{user}', [AdminController::class, 'show_pengguna'])->name('admin.pengguna.show');
    Route::get('/pengguna/{user}/edit', [AdminController::class, 'edit_pengguna'])->name('admin.pengguna.edit');
    Route::put('/pengguna/update/{user}', [AdminController::class, 'update_pengguna'])->name('admin.pengguna.update');
    Route::delete('/pengguna/{user}', [AdminController::class, 'destroy_pengguna'])->name('admin.pengguna.destroy');

    //pengaturan
    Route::get('/pengaturan', [AdminController::class, 'pengaturan'])->name('admin.pengaturan');
    Route::post('/pengaturan/update', [AdminController::class, 'updatepengaturan'])->name('admin.pengaturan.update');

    //laporan
    Route::get('/laporan/masuk', [AdminController::class, 'lapbarangmasuk'])->name('admin.laporan.masuk');
    Route::get('/laporan/keluar', [AdminController::class, 'lapbarangkeluar'])->name('admin.laporan.keluar');
    Route::get('/laporan/stok-barang', [AdminController::class, 'lapstockbarang'])->name('admin.laporan.stock');

    //Stock
    Route::get('/stock', [AdminController::class, 'riwayat'])->name('admin.stock');
    //stock opname
    // Route::get('/opname', [AdminController::class, 'opname'])->name('admin.opname');
    // Route::post('/opname{id}/setuju', [AdminController::class, 'setuju'])->name('admin.opname.setuju');
    // Route::post('/opname{id}/tolak', [AdminController::class, 'tolak'])->name('admin.opname.tolak');


     //opname test
    Route::get('/opname', [AdminController::class, 'index2'])->name('admin.opname');
    Route::get('/opname/{id}', [AdminController::class, 'detail'])->name('admin.opname.detail');


    //min stock
    Route::get('/minimum_stock', [AdminController::class, 'minstock'])->name('admin.minstock');
    Route::post('/minimum_stock/update', [AdminController::class, 'updatemin'])->name('admin.minstock.update');
    Route::post('/minimum_stock/ningkat{produk}', [AdminController::class, 'ningkatmin'])->name('admin.minstock.ningkat');
    Route::post('/minimum_stock/turun{produk}', [AdminController::class, 'turunmin'])->name('admin.minstock.turun');

    //ACT LOG
    Route::get('/aktivitas',[AdminController::class,'aktivitaspengguna'])->name('admin.aktivitas');
    Route::get('/aktivitas',[AdminController::class,'lapaktivitaspengguna'])->name('admin.lapaktivitas');
    Route::get('/aktivitas/{id}',[AdminController::class,'showak'])->name('admin.aktivitas.detail');

    //pw
    Route::put('/pengguna/{user}/reset-password', [AdminController::class, 'resetpw'])->name('admin.pengguna.reset');
});



//Manajer
Route::prefix('manajer')->middleware('auth')->middleware('userAkses:manajer_cabang')->group(function () {
    Route::get('/dashboard', [ManajerController::class, 'index'])->name('manajer.dashboard');
    // Route::get('/stock',[ManajerController::class,'notifikasi'])->name('manajer.notifikasi');

    //produk
    Route::get('/produk', [ManajerController::class, 'produk'])->name('manajer.produk');
    Route::get('/produk/{produk}', [ManajerController::class, 'show_produk'])->name('manajer.produk.show');

    //supplier
    Route::get('/supplier', [ManajerController::class, 'supplier'])->name('manajer.supplier');

    //Barang Masuk
    Route::get('/stock', [ManajerController::class, 'stock'])->name('manajer.stock');
    Route::get('/stock/masuk/create', [StockMasukController::class, 'create'])->name('manajer.stock.create');
    Route::post('/stock/masuk/store', [StockMasukController::class, 'store'])->name('manajer.stock.store');

    //Barang Keluar
    Route::get('/stock/keluar/create', [StockKeluarController::class, 'create'])->name('manajer.stock.keluar.create');
    Route::post('/stock/keluar/store', [StockKeluarController::class, 'store'])->name('manajer.stock.keluar.store');

    // //opname
    // Route::get('/opname',[ManajerController::class,'opname'])->name('manajer.opname');
    // Route::post('/opname',[ManajerController::class,'simpan_opname'])->name('manajer.opname.simpan');
    // // Route::get('/opname/{stock}',[ManajerController::class,'show_opname'])->name('manajer.opname.show');
    // Route::get('/opname/{produk}/detail', [ManajerController::class, 'detail_opname'])->name('manajer.opname.show');

    //laporan
    Route::get('/laporan/masuk', [ManajerController::class, 'lapbarangmasuk'])->name('manajer.laporan.masuk');
    Route::get('/laporan/keluar', [ManajerController::class, 'lapbarangkeluar'])->name('manajer.laporan.keluar');
    Route::get('/laporan/stok-barang', [ManajerController::class, 'lapstockbarang'])->name('manajer.laporan.stock');


    //opname benar
    // Route::get('/opname', [StockOpnameController::class, 'index'])->name('manajer.opname');
    // Route::post('/opname', [StockOpnameController::class, 'store'])->name('manajer.opname.store');
    // Route::get('/opname/show', [StockOpnameController::class, 'show'])->name('manajer.opname.show');
    // Route::post('/opname/hitung', [StockOpnameController::class, 'hitung'])->name('manajer.opname.hitung');

    //opname test
    Route::get('/opname', [StockOpnameController::class, 'index2'])->name('manajer.opname');
    Route::get('/opname/{id}', [StockOpnameController::class, 'detail'])->name('manajer.opname.detail');
});


//STAFF
Route::prefix('staff')->middleware('auth')->middleware('userAkses:staff_gudang')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');

    //Konfirmasi keluar masuk
    Route::get('/konfirmasi', [StaffController::class, 'konfirmasi'])->name('staff.konfirmasi');
    Route::put('/konfirmasi/update/{transaksi}', [StaffController::class, 'updateKonfirmasi'])->name('staff.konfirmasi.update');

    //opname benar
    Route::get('/opname', [StaffController::class, 'index3'])->name('staff.opname');
    Route::post('/opname', [StaffController::class, 'store'])->name('staff.opname.store');
    Route::get('/opname/show', [StaffController::class, 'show'])->name('staff.opname.show');
    Route::post('/opname/hitung', [StaffController::class, 'hitung'])->name('staff.opname.hitung');
});



//Export data
Route::get('/produk/export', function () {
    
    activity_log(
     "Export Produk",
     "Melakukan Export data produk ke file excel",
     "Produk",
     [
        'user_id' => auth()->id(),
        'action' => 'Export Produk',
        'file' => 'produk.xlsx'
     ]
    );

    return Excel::download(new ProdukExport, 'produk.xlsx');
})->name('admin.produk.export');

//Import data
Route::post('/produk/import', function () {
    Excel::import(new ProdukImport, request()->file('file'));

    activity_log(
     "Import Produk",
     "Melakukan Import data produk dari file excel",
     "Produk",
     [
        'user_id' => auth()->id(),
        'action' => 'Import Produk',
        'file' => request()->file('file')->getClientOriginalName()
     ]
    );
    
    return back()->with('success', 'Import berhasil');
})->name('admin.produk.import');


Route::get('/cek-remember', function () {
    if (Auth::check()) {
        return 'Login sebagai: ' . Auth::user()->name . ' (' . Auth::user()->role . ')';
    }
    return 'Belum login';
})->middleware('web');
