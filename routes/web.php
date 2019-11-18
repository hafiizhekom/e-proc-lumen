<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) { 
    return $router->app->version();
});


// $router->get('user3', 'UserController@show3'); 
$router->get('user/jenis_kelamin', 'UserController@showJenisKelamin');

$router->group(['middleware' => ['auth']], function () use ($router) {
    $router->get('user', 'UserController@show');
    $router->get('user/current', 'UserController@showCurrent');    
    $router->get('user/{id}', 'UserController@showByID');
    

    $router->get('vendor/download', [
        'uses' => 'VendorController@download'
    ]);

    $router->post('vendor/detail/store', [
        'middleware' => 'vendordetail',
        'uses' => 'VendorController@storeDetail'
    ]);

    $router->get('vendor/dokumen/{id}', 'VendorController@showDokumenByID');
    $router->post('vendor/dokumen/store', [
        'middleware' => 'vendordokumen',
        'uses' => 'VendorController@storeDokumen'
    ]);

    $router->get('vendor/kategori/', 'VendorController@showKategori');
    $router->get('vendor/kategori/{id}', 'VendorController@showKategoriByID');
    $router->post('vendor/kategori/store', [
        'middleware' => 'vendorkategori',
        'uses' => 'VendorController@storeKategori'
    ]);

    $router->get('vendor/tipe', 'VendorController@showTipe');
    $router->get('vendor/tipe/{id}', 'VendorController@showTipeByID');
    $router->post('vendor/tipe/store', [
        'middleware' => 'tender',
        'uses' => 'TenderController@store'
    ]);

    $router->get('vendor', 'VendorController@show');
    $router->get('vendor/{id}', 'VendorController@showByID');
    $router->get('vendor/user/{id_pemilik}', 'VendorController@showByPemilik');
    $router->post('vendor/store', [
        'middleware' => 'vendor',
        'uses' => 'VendorController@store'
    ]);

    $router->get('tender/tahap', 'TahapController@showTahap');
    $router->get('tender/tahap/{id}', 'TahapController@showTahapByID');
    $router->post('tender/tahap/store', [
        'middleware' => 'tendertahap',
        'uses' => 'TahapController@store'
    ]);

    
    $router->get('tender/kualifikasi', 'KualifikasiController@show');
    $router->get('tender/kualifikasi/{id}', 'KualifikasiController@showByID');
    $router->post('tender/kualifikasi/store', [
        'middleware' => 'tenderkualifikasi',
        'uses' => 'KualifikasiController@store'
    ]);

    $router->get('tender/metodedokumen', 'MetodeDokumenController@show');
    $router->get('tender/metodedokumen/{id}', 'MetodeDokumenController@showByID');
    $router->post('tender/metodedokumen/store', [
        'middleware' => 'tendermetodedokumen',
        'uses' => 'MetodeDokumenController@store'
    ]);

    $router->get('tender/metodeevaluasi', 'MetodeEvaluasiController@show');
    $router->get('tender/metodeevaluasi/{id}', 'MetodeEvaluasiController@showByID');
    $router->post('tender/metodeevaluasi/store', [
        'middleware' => 'tendermetodeevaluasi',
        'uses' => 'MetodeEvaluasiController@store'
    ]);

    $router->get('tender/metodekualifikasi', 'MetodeKualifikasiController@show');
    $router->get('tender/metodekualifikasi/{id}', 'MetodeKualifikasiController@showByID');
    $router->post('tender/metodekualifikasi/store', [
        'middleware' => 'tendermetodekualifikasi',
        'uses' => 'MetodeKualifikasiController@store'
    ]);

    $router->get('tender/metodepengadaan', 'MetodePengadaanController@show');
    $router->get('tender/metodepengadaan/{id}', 'MetodePengadaanController@showByID');
    $router->post('tender/metodepengadaan/store', [
        'middleware' => 'tendermetodepengadaan',
        'uses' => 'MetodePengadaanController@store'
    ]);

    $router->get('tender/carapembayaran', 'CaraPembayaranController@show');
    $router->get('tender/carapembayaran/{id}', 'CaraPembayaranController@showByID');
    $router->post('tender/metodepengadaan/store', [
        'middleware' => 'tendercarapembayaran',
        'uses' => 'CaraPembayaranController@store'
    ]);

    $router->get('tender/kebutuhan', 'KebutuhanController@show');
    $router->get('tender/kebutuhan/{id}', 'KebutuhanController@showByID');
    $router->post('tender/kebutuhan/store', [
        'middleware' => 'tenderkebutuhan',
        'uses' => 'KebutuhanController@store'
    ]);

    $router->get('tender/kebutuhanbarang', 'BarangController@show');
    $router->get('tender/kebutuhanbarang/{id}', 'BarangController@showByID');
    $router->post('tender/kebutuhanbarang/store', [
        'middleware' => 'tenderkebutuhanbarang',
        'uses' => 'BarangController@store'
    ]);

    $router->get('tender/kebutuhansatuan', 'SatuanController@show');
    $router->get('tender/kebutuhansatuan/{id}', 'TenderController@showByID');
    $router->post('tender/kebutuhansatuan/store', [
        'middleware' => 'tenderkebutuhansatuan',
        'uses' => 'SatuanController@store'
    ]);

    $router->post('tender/detail/store', [
        'middleware' => 'tenderdetail',
        'uses' => 'TenderController@storeDetail'
    ]);

    $router->get('tender', 'TenderController@show');
    $router->get('tender/{id}', 'TenderController@showByID');
    $router->get('tender/user/{id_user}', 'TenderController@showByUser');
    $router->post('tender/store', [
        'middleware' => 'tender',
        'uses' => 'TenderController@store'
    ]);

    

    $router->get('bid', 'BidController@show');
    $router->get('bid/tender/{id_tender}', 'BidController@showByTender');
    $router->post('bid/tender/store', [
        'middleware' => 'bidtendervendor',
        'uses' => 'BidController@store'
    ]);

    $router->get('bid/tender/tahap/{id_tender}', 'TenderController@showTahapByTender');
    $router->post('bid/tender/tahap/store', [
        'middleware' => 'bidtendertahap',
        'uses' => 'BidController@storeTahap'
    ]);

});

$router->post('login', [
    'middleware' => 'login',
    'uses' => 'AuthController@login'
]);

$router->post('register', [
    'middleware' => 'register',
    'uses' => 'AuthController@register'
]);

