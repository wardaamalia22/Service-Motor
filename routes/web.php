<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Psy\TabCompletion\AutoCompleter;

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

Route::get('/','UserController@homeuser')->name('homeuser');
Route::get('/tentangkami','UserController@tentangkami')->name('tentangkami');
Route::get('/detailartikel{artikel}','UserController@detailartikel')->name('detailartikel');
Route::get('/login','AdminController@login')->name('login');
Route::get('/ShowRegisterForm', [AuthController::class, 'showRegisterForm'])->name('ShowRegisterForm');
Route::post('/postRegister', [AuthController::class, 'postRegister'])->name('postRegister');
// Route::post('/register', [AdminController::class, 'register'])->name('register');

// si ribet 
Route::get('/showLoginForm','AuthController@showLoginForm')->name('showLoginForm');
Route::post('/postLogin','AuthController@postLogin')->name('postLogin');
Route::post('/logout','AuthController@logout')->name('logout');
Route::get('/profil','UserController@profil')->name('profil')->middleware('auth');
Route::get('/homeuser','UserController@homeuser')->name('homeuser');

//Bagian kelola admin dasbor
Route::get('/homeadmin','AdminController@homeadmin')->name('homeadmin');
Route::get('/kelolapengguna','UserController@kelolapengguna')->name('kelolapengguna');
Route::get('/kelolamekanik','MekanikController@kelolamekanik')->name('kelolamekanik');
Route::get('/kelolakasir','KasirController@kelolakasir')->name('kelolakasir');
Route::get('/kelolabooking','BookingController@kelolabooking')->name('kelolabooking');
Route::get('/booking','BookingController@booking')->name('booking');
Route::post('/postBooking','BookingController@postBooking')->name('postBooking');
Route::get('/keloladetailbooking',[BookingController::class,'keloladetailbooking'])->name('keloladetailbooking');

// crud kelola pengguna
Route::get('/tambahuser','UserController@tambahuser')->name('tambahuser');
Route::post('/postTambahUser','UserController@postTambahUser')->name('postTambahUser');
Route::get('/edituser{pengguna}','UserController@edituser')->name('edituser');
Route::post('/postEditUser{pengguna}','UserController@postEditUser')->name('postEditUser');
Route::get('/hapusUser{pengguna}','UserController@hapusUser')->name('hapusUser');

// crud kelola mekanik
Route::get('/tambahmekanik','MekanikController@tambahmekanik')->name('tambahmekanik');
Route::post('/postTambahMekanik','MekanikController@postTambahMekanik')->name('postTambahMekanik');
Route::get('/editmekanik{mekanik}','MekanikController@editmekanik')->name('editmekanik');
Route::post('/postEditMekanik{mekanik}','MekanikController@postEditMekanik')->name('postEditMekanik');
Route::get('/hapusMekanik{mekanik}','MekanikController@hapusMekanik')->name('hapusMekanik');

// crud kelola kasir
Route::get('/tambahkasir','KasirController@tambahkasir')->name('tambahkasir');
Route::post('/postTambahKasir','KasirController@postTambahKasir')->name('postTambahKasir');
Route::get('/editkasir{kasir}','KasirController@editkasir')->name('editkasir');
Route::post('/postEditKasir{kasir}','KasirController@postEditKasir')->name('postEditKasir');
Route::get('/hapusKasir{kasir}','KasirController@hapusKasir')->name('hapusKasir');

//crud kelola booking
Route::get('/tambahbooking','BookingController@tambahbooking')->name('tambahbooking');
Route::post('/postTambahBooking','BookingController@postTambahBooking')->name('postTambahBooking');

//Bagian Mekanik dasbor
Route::get('/homemekanik','MekanikController@homemekanik')->name('homemekanik');
Route::get('/pesanan','MekanikController@pesanan')->name('pesanan');
Route::get('/barang','MekanikController@barang')->name('barang');
Route::post('/tambahBarang', [MekanikController::class, 'tambahBarang'])->name('tambahBarang');
Route::get('/order/{id}', [MekanikController::class, 'order'])->name('order');
Route::post('/order/edit/{id}', [MekanikController::class, 'editOrder'])->name('editorder');

//kelola owner
Route::get('/homeowner','OwnerController@homeowner')->name('homeowner');
Route::get('/kelolaowner','OwnerController@kelolaowner')->name('kelolaowner');
Route::get('/laporanlog','OwnerController@laporanlog')->name('laporanlog');

//Bagian Kasir Dasbaor
Route::get('/homekasir','KasirController@homekasir')->name('homekasir');
// Route::get('/pesananuser/{id}', [KasirController::class, 'pesananuser'])->name('pesananuser');
Route::get('/pesananuser', [KasirController::class, 'pesananuser'])->name('pesananuser');
Route::get("/bukti/{id}","KasirController@bukti")->name("bukti");
Route::get('/confirm/{booking}',[KasirController::class,'confirm'])->name('confirm');
Route::get('/detailtransaksi/detail/{id}', [KasirController::class, 'show'])->name('detailtransaksi');
Route::post('/editconfirm/{booking}',[KasirController::class,'editconfirm'])->name('editconfirm');
Route::get('/pesananoffline','kasirController@pesananoffline')->name('pesananoffline');
Route::post('/tambahPesanan', [KasirController::class, 'tambahPesanan'])->name('tambahPesanan');
Route::get('/uangpepe', [MekanikController::class, 'uangpepe'])->name('uangpepe');
Route::post('/store', [MekanikController::class, 'store'])->name('store');

//transaksi
Route::get('/DT/{id}', [TransaksiController::class, 'DT'])->name('DT');
Route::post("/bayar","TransaksiController@bayar")->name("bayar");
Route::post('/tambahDT', [TransaksiController::class, 'tambahDT'])->name('tambahDT');
Route::get('/homeDT',[TransaksiController::class,'homeDT'])->name('homeDT');










