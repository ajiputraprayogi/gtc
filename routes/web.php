<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::prefix('backend')->group(function () {
    Route::get('/home', 'backend\HomeController@index')->name('home');
    Route::get('/edit-profile', 'backend\HomeController@editprofile')->name('editprofile');
    Route::post('/edit-profile/{id}', 'backend\HomeController@aksieditprofile');

    Route::resource('/roles','backend\rolesController');
    Route::get('/data-roles','backend\rolesController@listdata');
    
    Route::resource('/pengaturan-akun','backend\AdminController');
    Route::get('/data-admin','backend\AdminController@listdata');
    Route::get('/cari-pengaturan-akun/{id}/edit', 'backend\AdminController@caripengaturanakun');
    Route::get('/web-setting', 'backend\HomeController@websetting');
    Route::post('/web-setting', 'backend\HomeController@updatewebsetting');

    Route::resource('/harga-emas', 'backend\HargaemasController');
    Route::get('/cari-data-harga-harian', 'backend\HargaemasController@listdata');
    Route::get('/cari-data-harga-harian/{id}/edit', 'backend\HargaemasController@caridetailhargaharian');

    Route::resource('/jenis-jasa-gtc', 'backend\JenisjasagtcController');
    Route::get('/cari-data-jenis-jasa-gtc', 'backend\JenisjasagtcController@listdata');
    Route::get('/cari-data-jenis-jasa-gtc/{id}/edit', 'backend\JenisjasagtcController@caridetailjenisjasa');

    Route::get('/whatsapp-gtc','backend\WhatsappGtcController@index');
    Route::post('/whatsapp-gtc/edit','backend\WhatsappGtcController@edit')->name('edit-konten-wa');


    Route::resource('/pengajuan-gtc', 'backend\PengajuangtcController');
    Route::get('/list-pengajuan-gtc', 'backend\PengajuangtcController@listpengajuangtc');
    Route::put('/tambah-data-cif-anggota/{id}', 'backend\PengajuangtcController@tambahdatacifanggota');
    Route::get('/cari-data-histori-anggota/{kode}', 'backend\PengajuangtcController@historianggota');
    Route::get('/aproval-bm-pengajuan-gtc/{id}', 'backend\PengajuangtcController@aprovalbmpengajuangtc');
    Route::put('/edit-aproval-bm-pengajuan-gtc/{id}', 'backend\PengajuangtcController@editaprovalbmpengajuangtc');
    Route::get('/aproval-opr-pengajuan-gtc/{id}', 'backend\PengajuangtcController@aprovaloprpengajuangtc');
    Route::put('/edit-aproval-opr-pengajuan-gtc/{id}', 'backend\PengajuangtcController@editaprovaloprpengajuangtc');
    Route::get('/aproval-keu-pengajuan-gtc/{id}', 'backend\PengajuangtcController@aprovalkeupengajuangtc');
    Route::put('/edit-aproval-keu-pengajuan-gtc/{id}', 'backend\PengajuangtcController@editaprovalkeupengajuangtc');
    Route::get('/tambah-pengajuan-gtc', 'backend\PengajuangtcController@tambahpengajuangtc');
    Route::get('/view-pengajuan-gtc/{id}', 'backend\PengajuangtcController@viewpengajuangtc');
    Route::get('/edit-pengajuan-gtc/{id}', 'backend\PengajuangtcController@editpengajuangtc');
    Route::get('/del-pengajuan-gtc', 'backend\PengajuangtcController@delpengajuangtc');
    Route::get('/print-pengajuan-gtc/{id}', 'backend\PengajuangtcController@printpengajuangtc');
    Route::get('/view-histori-pengajuan/{id}', 'backend\PengajuangtcController@viewhistoripengajuan');
    Route::delete('/restore-histori-pengajuan/{id}', 'backend\PengajuangtcController@restorehistoripengajuan');
    Route::get('/cari-nomor-ba/{id}', 'backend\PengajuangtcController@carinomorba');
    Route::get('/cari-nomor-ba-hasil/{id}', 'backend\PengajuangtcController@carinomorbahasil');
    Route::get('/cari-kode-pengajuan-hasil/{id}', 'backend\PengajuangtcController@carikodepengajuanhasil');
    Route::get('/cari-data-emas-gtc/{kode}', 'backend\PengajuangtcController@listemasgtc');
    Route::post('/add-emas-gtc', 'backend\PengajuangtcController@addemasgtc');
    Route::delete('/delete-emas-gtc/{id}', 'backend\PengajuangtcController@deleteemasgtc');

    Route::get('/item-emas-syirkah/{id}', 'backend\PengajuangtcController@emassyirkah');
    Route::get('/tabel-emas-gtc', 'backend\PengajuangtcController@tabelemasgtc');
    Route::get('/add-tabel-emas-gtc/{id}/{pengajuan}', 'backend\PengajuangtcController@addtabelemasgtc');
    Route::put('/edit-keping/{id}', 'backend\PengajuangtcController@editkeping');

    Route::resource('/aktif-gtc', 'backend\AktifgtcController');
    Route::get('/transaksi-gtc/{id}', 'backend\AktifgtcController@transaksi');
    Route::get('/transaksi2/{id}', 'backend\AktifgtcController@transaksi2');
    Route::get('/list-transaksi/{id}', 'backend\AktifgtcController@listtransaksi');
    Route::get('/list-tambah-transaksi/{id}', 'backend\AktifgtcController@listtambahtransaksi');
    Route::get('/list-edit-transaksi/{kode}/{kode2}', 'backend\AktifgtcController@listedittransaksi');
    Route::post('/tambah-transaksi', 'backend\AktifgtcController@tambahtransaksi');
    Route::put('/edit-transaksi/{id}', 'backend\AktifgtcController@edittransaksi');
    Route::get('/cari-data-emas-transaksi-gtc/{kode}', 'backend\AktifgtcController@listemasgtc');
    Route::get('/cari-edit-data-emas-transaksi-gtc/{kode}/{kode2}', 'backend\AktifgtcController@listeditemasgtc');
    Route::get('/cari-view-data-emas-transaksi-gtc/{kode}/{kode2}', 'backend\AktifgtcController@listviewemasgtc');
    Route::get('/print-transaksi/{kode}/{kode2}', 'backend\AktifgtcController@printtransaksi');
    Route::get('/jasadiakhir-transaksi/{kode}/{kode2}', 'backend\AktifgtcController@jasadiakhirtransaksi');
    Route::get('/jasadiakhir-transaksi/{kode}/{kode2}', 'backend\AktifgtcController@jasadiakhirtransaksi');
    Route::put('/simpan-jasadiakhir-transaksi/{id}', 'backend\AktifgtcController@simpanjasadiakhirtransaksi');
    Route::get('/cari-data-transaksi/{id}', 'backend\AktifgtcController@caridatatransaksi');
    Route::put('/upload-buktitrf/{id}', 'backend\AktifgtcController@uploadbuktitrf');
    Route::put('/aproval-opr/{id}', 'backend\AktifgtcController@aprovalopr');
    Route::put('/aproval-keu/{id}/{id_anggota}', 'backend\AktifgtcController@aprovalkeu');
    Route::get('/cek-pelunasan-gtc/{id}', 'backend\AktifgtcController@cekpelunasangtc');
    Route::get('/pelunasan-gtc/{id}', 'backend\AktifgtcController@pelunasangtc');
    Route::get('/cetak-sbte/{kode}/{kode2}', 'backend\AktifgtcController@cetaksbte');

    Route::resource('/lunas-gtc', 'backend\LunasgtcController');
    Route::resource('/histori-transaksi-gtc', 'backend\HistoritransaksigtcController');
});
