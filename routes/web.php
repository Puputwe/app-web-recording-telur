<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\PopulasiController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\PakanMasukController;
use App\Http\Controllers\RecordingController;
use App\Http\Controllers\FormController;


Route::get('/', function () {
    return view('home');
});

// LOGIN & LOGOUT
Route::get('/login', [LoginController::class, 'halamanlogin'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/postregister', [LoginController::class, 'postregister'])->name('postregister');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

//--- HALAMAN USER ----//

Route::middleware(['auth', 'user'])->group(function () {

    Route::get('/dashboard/user', [FormController::class, 'index'])->name('dashboard.user');

    Route::get('/performa/ajax', [FormController::class, 'ajaxPerforma'])->name('ajax.performa');
    Route::get('/recording/performa', [FormController::class, 'createPerforma'])->name('create.performa');
    Route::post('/performa/store', [FormController::class, 'storePerforma'])->name('store.performa');

    Route::get('/laporan', [FormController::class, 'laporanPerforma'])->name('laporanPerforma');
    Route::get('/laporan/search', [FormController::class, 'searchLaporan'])->name('searchLaporan');
    Route::get('/laporan/grafik', [FormController::class, 'laporanGrafik'])->name('laporanGrafik');

    Route::get('/produksi/telur', [FormController::class, 'produksiTelur'])->name('produksiTelur');
    Route::get('/form/{id}/produksi', [FormController::class, 'formProduksi'])->name('formProduksi');
    Route::get('/scan/produksi', [FormController::class, 'qrScanner'])->name('qrScanner');
    Route::post('/form/store', [FormController::class, 'store'])->name('formStore');
    Route::post('/form/storeAll', [FormController::class, 'storeAll'])->name('formStoreAll');
});


//--- HALAMAN ADMIN ---//

Route::middleware(['auth', 'admin'])->group(function () {
    
        //ROLE
        Route::get('/role', [RoleController::class, 'index'])->name('role');
        Route::post('/role/store', [RoleController::class, 'store'])->name('store-role');
        Route::get('/role/{id}/update', [RoleController::class, 'update'])->name('update-role');
        Route::get('/role/{id}/delete', [RoleController::class, 'delete'])->name('delete-role');

        //USER
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::post('/user/create', [UserController::class, 'create'])->name('create-user');
        Route::post('/user/{id}/update', [UserController::class, 'update'])->name('update-user');
        Route::get('/user/{id}/delete', [UserController::class, 'delete'])->name('delete-user');
        Route::get('/user/{id}/upStatus',  [UserController::class, 'upStatus'])->name('upStatus-user');

        Route::get('/user/trash', [UserController::class, 'trash'])->name('user_trash');
        Route::get('/user/restore/{id}', [UserController::class, 'restore'])->name('user_restore');
        Route::get('/user/delete_kill/{id}', [UserController::class, 'delete_kill'])->name('user_delete');
        Route::get('/user/delete_all', [UserController::class, 'delete_all'])->name('user_delete_all');

        //KANDANG
        Route::get('/kandang', [KandangController::class, 'index'])->name('kandang');
        Route::post('/kandang/store', [KandangController::class, 'store'])->name('store-kandang');
        Route::post('/kandang/{id}/update', [KandangController::class, 'update'])->name('update-kandang');
        Route::get('/kandang/{id}/delete', [KandangController::class, 'delete'])->name('delete-kandang');
        Route::get('/kandang/{id}/detail', [KandangController::class, 'detail'])->name('detail-kandang');
        Route::get('/kandang/{id}/upStatus',  [KandangController::class, 'upStatus'])->name('upStatus-kandang');

        Route::get('/kandang/populasiexport/{id}', [KandangController::class, 'populasiexport'])->name('populasiexport');
        Route::get('/kandang/cetak_populasi/{id}', [KandangController::class, 'cetak_populasi'])->name('cetak_populasi');

        Route::get('/kandang/trash', [KandangController::class, 'trash'])->name('kandang_trash');
        Route::get('/kandang/restore/{id}', [KandangController::class, 'restore'])->name('kandang_restore');
        Route::get('/kandang/delete_kill/{id}', [KandangController::class, 'delete_kill'])->name('kandang_delete');
        Route::get('/kandang/delete_all', [KandangController::class, 'delete_all'])->name('kandang_delete_all');


        //POPULASI
        Route::get('/populasi', [PopulasiController::class, 'index'])->name('populasi');
        Route::post('/populasi/store', [PopulasiController::class, 'store'])->name('store-populasi');
        Route::post('/populasi/{id}/update', [PopulasiController::class, 'update'])->name('update-populasi');
        Route::get('/populasi/{id}/delete', [PopulasiController::class, 'delete'])->name('delete-populasi');
        Route::get('/populasi/{id}/detail', [PopulasiController::class, 'detail'])->name('detail-populasi');
        Route::post('/populasi/importpopulasi', [PopulasiController::class, 'importpopulasi'])->name('importpopulasi');

        Route::get('/populasi/trash', [PopulasiController::class, 'trash'])->name('populasi_trash');
        Route::get('/populasi/restore/{id}', [PopulasiController::class, 'restore'])->name('populasi_restore');
        Route::get('/populasi/delete_kill/{id}', [PopulasiController::class, 'delete_kill'])->name('populasi_delete');
        Route::get('/populasi/delete_all', [PopulasiController::class, 'delete_all'])->name('populasi_delete_all');

        //PRODUKSI
        Route::get('/produksi', [ProduksiController::class, 'index'])->name('produksi');
        Route::post('/produksi/store', [ProduksiController::class, 'store'])->name('store-produksi');
        Route::post('/produksi/{id}/update', [ProduksiController::class, 'update'])->name('update-produksi');
        Route::get('/produksi/{id}/delete', [ProduksiController::class, 'delete'])->name('delete-produksi');
        Route::get('/produksi/produksi_export', [ProduksiController::class, 'produksi_export'])->name('produksi_export');
        Route::post('/produksi/produksi_import', [ProduksiController::class, 'produksi_import'])->name('produksi_import');

        Route::get('/produksi/trash', [ProduksiController::class, 'trash'])->name('produksi_trash');
        Route::get('/produksi/{id}/restore', [ProduksiController::class, 'restore'])->name('produksi_restore');
        Route::get('/produksi/delete_kill/{id}', [ProduksiController::class, 'delete_kill'])->name('produksi_delete');
        Route::get('/produksi/delete_all', [ProduksiController::class, 'delete_all'])->name('produksi_delete_all');

        //PAKAN
        Route::get('/pakan', [PakanController::class, 'index'])->name('pakan');
        Route::post('/pakan/store', [PakanController::class, 'store'])->name('store-pakan');
        Route::post('/pakan/{id}/update', [PakanController::class, 'update'])->name('update-pakan');
        Route::get('/pakan/{id}/delete', [PakanController::class, 'delete'])->name('delete-pakan');

        Route::get('/pakan/trash', [PakanController::class, 'trash'])->name('pakan_trash');
        Route::get('/pakan/restore/{id}', [PakanController::class, 'restore'])->name('pakan_restore');
        Route::get('/pakan/delete_kill/{id}', [PakanController::class, 'delete_kill'])->name('pakan_delete');
        Route::get('/pakan/delete_all', [PakanController::class, 'delete_all'])->name('pakan_delete_all');

        //STOK-PAKAN
        Route::get('/stok-pakan', [PakanMasukController::class, 'index'])->name('stok-pakan');
        Route::get('/stok-pakan/ajax', [PakanMasukController::class, 'ajax'])->name('ajax.stok-pakan');
        Route::get('/stok-pakan/create', [PakanMasukController::class, 'create'])->name('create.stok-pakan');
        Route::post('/stok-pakan/store', [PakanMasukController::class, 'store'])->name('store.stok-pakan');
        Route::get('/stok-pakan/{id}/{p_id}/{p_jml}/delete', [PakanMasukController::class, 'delete'])->name('delete.stok-pakan');

        Route::get('/stok-pakan/trash', [PakanMasukController::class, 'trash'])->name('stok_trash');
        Route::get('/stok-pakan/{id}/{p_id}/{p_jml}/restore', [PakanMasukController::class, 'restore'])->name('stok_restore');
        Route::get('/stok-pakan/delete_all', [PakanMasukController::class, 'delete_all'])->name('stok_delete_all');
        Route::get('/stok-pakan/delete_kill/{id}', [PakanMasukController::class, 'delete_kill'])->name('stok_delete');

        //RECORDING
        Route::get('/recording', [RecordingController::class, 'index'])->name('recording');
        Route::get('/recording/ajax', [RecordingController::class, 'ajax'])->name('ajax.recording');
        Route::get('/recording/create', [RecordingController::class, 'create'])->name('create.recording');
        Route::post('/recording/store', [RecordingController::class, 'store'])->name('store.recording');
        Route::get('/recording/{id}/{p_id}/{p_jml}/delete', [RecordingController::class, 'delete'])->name('delete.recording');

        Route::get('/recording/search', [RecordingController::class, 'searchRecording'])->name('searchRecording');
        Route::get('/recording/recording_export', [RecordingController::class, 'recording_export_all'])->name('recording_export_all');
        Route::get('/recording/recording_export/{id}', [RecordingController::class, 'recording_export'])->name('recording_export');
        Route::post('/recording/recording_import', [RecordingController::class, 'recording_import'])->name('recording_import');
        Route::get('/recording/cetak_recording', [RecordingController::class, 'cetak_recording'])->name('cetak_recording');

        Route::get('/recording/trash', [RecordingController::class, 'trash'])->name('recording_trash');
        Route::get('/recording/{id}/{p_id}/{p_jml}/restore', [RecordingController::class, 'restore'])->name('recording_restore');
        Route::get('/recording/delete_all', [RecordingController::class, 'delete_all'])->name('recording_delete_all');
        Route::get('/recording/delete_kill/{id}', [RecordingController::class, 'delete_kill'])->name('recording_delete');

        Route::get('/recording/grafik', [RecordingController::class, 'grafik'])->name('grafik');
});