<?php

use App\Http\Controllers\AuthCTRL;
use App\Http\Controllers\DashCTRL;
use App\Http\Controllers\CreateCTRL;
use App\Http\Controllers\MonitorCTRL;
use App\Http\Controllers\PegawaiCTRL;
use Illuminate\Support\Facades\Route;

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


// Route::middleware(['guest:pegawai'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');


    Route::post('/proses_masuk', [AuthCTRL::class, 'logindex'])->name('loginin');
// });

Route::middleware(['auth:pegawai'])->group(function(){
    Route::get('/admin', [DashCTRL::class, 'omahindex']);
    Route::get('/proses_keluar', [AuthCTRL::class, 'logoutUser']);
    Route::get('/ijin', [CreateCTRL::class, 'ijin']);
    Route::get('/presensi/create', [CreateCTRL::class, 'buat']);
    Route::get('/presensi/riwayat', [CreateCTRL::class, 'history']);
    Route::post('/presensi/store', [CreateCTRL::class, 'simpan']);
    Route::get('/presensi/editprof', [CreateCTRL::class, 'editProfile']);
    Route::post('/presensi/update/{id}',[CreateCTRL::class, 'updateprofile']);
    Route::post('/presensi/gethis',[CreateCTRL::class, 'gethistory']);
    Route::get('/presensi/buatijin',[CreateCTRL::class, 'buatijin'] );
    Route::post('/presensi/dataijin',[CreateCTRL::class, 'simpanijin'] );
    Route::post('//panel/cekajuijin',[CreateCTRL::class,'monitortglijin']);
});

// Route::middleware(['auth:user'])->group(function(){

// }); /panel/deletekaryawan/

Route::middleware(['auth:user'])->group(function(){
    Route::get('/panel/admindash', [DashCTRL::class, 'admindash']);
    Route::get('/proses_keluarmin', [AuthCTRL::class, 'logoutUser']);
    Route::get('/panel/karyawan', [PegawaiCTRL::class, 'indexing']);
    Route::get('/panel/mbahkaryawan', [PegawaiCTRL::class, 'nambah']);
    Route::post('/panel/nambahkaryawan', [PegawaiCTRL::class, 'simpan']);
    Route::post('/panel/nambahunit', [PegawaiCTRL::class, 'simpanunit']);
    Route::post('/panel/editkaryawan', [PegawaiCTRL::class, 'editk']);
    Route::post('/panel/editunit', [PegawaiCTRL::class, 'editu']);
    Route::get('/panel/unit', [PegawaiCTRL::class, 'units']);
    Route::post('/panel/updatekaryawan/{nik}', [PegawaiCTRL::class, 'updatek']);
    Route::post('/panel/deletekaryawan/{nik}', [PegawaiCTRL::class, 'delkar']);
    Route::post('/panel/deleteunit/{dep}', [PegawaiCTRL::class, 'delunit']);
    Route::post('/panel/updateunit/{dep}', [PegawaiCTRL::class, 'udetunit']);

    Route::get('/panel/absennya',[MonitorCTRL::class,'monitor']);
    // Route::get('/panel/petaabsennya/{lok}',[MonitorCTRL::class,'lokmonitor']);
    Route::get('/panel/petaabsennya/{id}',[MonitorCTRL::class,'lokmonitor']);
    Route::post('/panel/absensi',[MonitorCTRL::class,'monitorab']);

    Route::get('/panel/absenindi',[MonitorCTRL::class,'monitorindi']);
    Route::get('/panel/recap',[MonitorCTRL::class,'monitorecap']);
    Route::get('/panel/configktr',[MonitorCTRL::class,'settingktr']);
    Route::post('/panel/simpansetting',[MonitorCTRL::class,'settingsave']);
    Route::post('/panel/cetaklap',[MonitorCTRL::class,'monitorlap']);
    Route::post('/panel/cetakrekap',[MonitorCTRL::class,'monitorrekap']);

    Route::get('/panel/dataijin',[MonitorCTRL::class,'monitorijin']);

    Route::get(' /panel/editijins/{id}',[MonitorCTRL::class,'monitoreditijin']);
    Route::post(' /panel/updateijins/{id}',[MonitorCTRL::class,'monitorupdateijin']);
});


Route::get('/admins', function () {
    return view('auth.loginadmin');
})->name('loginadm');

Route::post('/admin_masuk', [AuthCTRL::class, 'loginmindex'])->name('loginmin');
