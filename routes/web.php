<?php

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

Route::get('/', function () {
    return view('auth.new_login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::match(["GET","post"],"/register", function(){
    return redirect('login');
});

Route::resource('user', 'UserController');
Route::resource('supplier', 'SupplierController');
Route::resource('pegawai', 'PegawaiController');
Route::resource('kategori', 'KategoriController');
Route::resource('produk', 'ProdukController');
Route::resource('transaksi_masuk', 'TransaksiMasukController');
Route::resource('agen','AgenController');
Route::resource('agen','AgenController');
Route::get('report_penjualan','ReportPenjualanController@index')->name('report_penjualan');
Route::get('cetak_pdf','ReportPenjualanController@cetak_pdf')->name('cetak_pdf');
Route::get('cetak_excel','ReportPenjualanController@cetak_excel')->name('cetak_excel');

Route::view('admin','layouts.star');
Route::view('template','layouts.template');