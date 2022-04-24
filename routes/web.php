<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KriteriaController;

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/kriteria',[KriteriaController::class,'index'])->name('kriteria');

    
    Route::get('/kriteria/add',[KriteriaController::class,'show_add'])->name('kriteria.add');
    Route::post('/kriteria/add',[KriteriaController::class,'add'])->name('kriteria.add');
    Route::get('/kriteria/edit/{id}',[KriteriaController::class,'show_edit'])->name('kriteria.edit');
    Route::post('/kriteria/edit/{id}',[KriteriaController::class,'edit'])->name('kriteria.edit');
    Route::get('/kriteria/delete/{id}',[KriteriaController::class,'delete'])->name('kriteria.delete');



    Route::get('/guru',[GuruController::class,'index'])->name('guru');
    Route::post('/guru',[GuruController::class,'save'])->name('guru');

    Route::get('/guru/add',[GuruController::class,'show_add'])->name('guru.add');
    Route::post('/guru/add',[GuruController::class,'add'])->name('guru.add');

    Route::get('/guru/delete/{id}',[GuruController::class,'delete'])->name('guru.delete');
    


    // Route::get('/bobot',[BobotController::class,'index'])->name('bobot');
    // Route::post('/bobot',[BobotController::class,'generate'])->name('bobot');


    
    // Route::get('/pegawai',[PegawaiController::class,'index'])->name('pegawai');
    // Route::post('/pegawai',[PegawaiController::class,'add'])->name('pegawai');
    // Route::get('/pegawai/edit/{pegawaiid}',[PegawaiController::class,'show_edit'])->name('pegawai.edit');
    // Route::post('/pegawai/edit/{pegawaiid}',[PegawaiController::class,'save'])->name('pegawai.edit');
    // Route::get('/pegawai/delete/{pegawaiid}',[PegawaiController::class,'delete'])->name('pegawai.delete');


    // Route::get('/nilai',[NilaiController::class,'index'])->name('nilai');
    // Route::post('/nilai',[NilaiController::class,'save'])->name('nilai');

});

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');
