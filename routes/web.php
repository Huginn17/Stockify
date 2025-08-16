<?php

use App\Exports\ProdukExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManajerController;
use App\Http\Controllers\StaffController;
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
    Route::get('/login',[AuthController::class,'index'])->name('login');
    Route::post('/login-proses',[AuthController::class,'loginproses'])->name('loginproses');
});

Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    //Admin 
Route::prefix('admin')->middleware('auth')->middleware('userAkses:admin')->group(function () {
    Route::get('/dashboard',[AdminController::class,'index'])->name('admin.dashboard');

    //PRODUK
    Route:
    Route::get('/produk',[AdminController::class,'produk'])->name('admin.produk');
    Route::get('/produk/create',[AdminController::class,'create_produk'])->name('admin.produk.create');
    Route::post('/produk/store',[AdminController::class,'store_produk'])->name('admin.produk.store');
    Route::get('/produk//{produk}',[AdminController::class,'show_produk'])->name('admin.produk.show');
    Route::get('/produk/{produk}/edit',[AdminController::class,'edit_produk'])->name('admin.produk.edit');
    Route::put('/produk/{produk:}',[AdminController::class,'update_produk'])->name('admin.produk.update');
    Route::delete('/produk/{produk}',[AdminController::class,'destroy_produk'])->name('admin.produk.destroy');


    //KATEGORI  
    Route::get('/kategori',[AdminController::class,'kategori'])->name('admin.kategori.index');
    Route::get('/kategori/create',[AdminController::class,'create_kategori'])->name('admin.kategori.create');
    Route::post('/kategori/store',[AdminController::class,'store_kategori'])->name('admin.kategori.store');
    Route::get('/kategori/{kategori}',[AdminController::class,'show_kategori'])->name('admin.kategori.show');
    Route::get('/kategori/{kategori}/edit',[AdminController::class,'edit_kategori'])->name('admin.kategori.edit');
    Route::put('/kategori/update/{kategori}',[AdminController::class,'update_kategori'])->name('admin.kategori.update');
    Route::delete('/kategori/{kategori}',[AdminController::class,'destroy_kategori'])->name('admin.kategori.destroy');



    //Supplier
    Route::get('/supplier',[AdminController::class,'supplier'])->name('admin.supplier.index');
    Route::get('/supplier/create',[AdminController::class,'create_supplier'])->name('admin.supplier.create');
    Route::post('/supplier/store',[AdminController::class,'store_supplier'])->name('admin.supplier.store');
    Route::get('/supplier/{supplier}',[AdminController::class,'show_supplier'])->name('admin.supplier.show');
    Route::get('/supplier/{supplier}/edit',[AdminController::class,'edit_supplier'])->name('admin.supplier.edit');
    Route::put('/supplier/update/{supplier}',[AdminController::class,'update_supplier'])->name('admin.supplier.update');
    Route::delete('/supplier/{supplier}',[AdminController::class,'destroy_supplier'])->name('admin.supplier.destroy');



    //Attribut
    Route::get('/attribut',[AdminController::class,'attribut'])->name('admin.attribut.index');
    Route::get('/attribut/create',[AdminController::class,'create_attribut'])->name('admin.attribut.create');
    Route::post('/attribut/store',[AdminController::class,'store_attribut'])->name('admin.attribut.store');
    Route::get('/attribut/{attribut}',[AdminController::class,'show_attribut'])->name('admin.attribut.show');
    Route::get('/attribut/{attribut}/edit',[AdminController::class,'edit_attribut'])->name('admin.attribut.edit');
    Route::put('/attribut/update/{attribut}',[AdminController::class,'update_attribut'])->name('admin.attribut.update');
    Route::delete('/attribut/{attribut}',[AdminController::class,'destroy_attribut'])->name('admin.attribut.destroy');



    //Pengguna
    Route::get('/pengguna',[AdminController::class,'pengguna'])->name('admin.pengguna.index');
    Route::get('/pengguna/create',[AdminController::class,'create_pengguna'])->name('admin.pengguna.create');
    Route::post('/pengguna/store',[AdminController::class,'store_pengguna'])->name('admin.pengguna.store');
    Route::get('/pengguna/{user}',[AdminController::class,'show_pengguna'])->name('admin.pengguna.show');
    Route::get('/pengguna/{user}/edit',[AdminController::class,'edit_pengguna'])->name('admin.pengguna.edit');
    Route::put('/pengguna/update/{user}',[AdminController::class,'update_pengguna'])->name('admin.pengguna.update');
    Route::delete('/pengguna/{user}',[AdminController::class,'destroy_pengguna'])->name('admin.pengguna.destroy');
});
   

    //Manajer
Route::prefix('manajer')->middleware('auth')->middleware('userAkses:manajer_cabang')->group(function () {
    Route::get('/dashboard',[ManajerController::class,'index'])->name('manajer.dashboard');
    Route::get('/stock',[ManajerController::class,'stock'])->name('manajer.stock');
});

    
    //staff
Route::prefix('staff')->middleware('auth')->middleware('userAkses:staff_gudang')->group(function () {
    Route::get('/dashboard',[StaffController::class,'index'])->name('staff.dashboard');
});



//Export data
Route::get('/produk/export', function () {
    return Excel::download(new ProdukExport, 'produk.xlsx');
})->name('admin.produk.export');

//Import data
Route::post('/produk/import', function () {
    Excel::import(new ProdukImport, request()->file('file'));
    return back()->with('success', 'Import berhasil');
})->name('admin.produk.import');
    