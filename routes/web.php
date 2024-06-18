<?php

use App\Livewire\Coba;
use App\Livewire\Login;
use App\Livewire\Dashboard;
use App\Livewire\Sppd\Sppd;
use App\Livewire\Sppd\SppdEdit;
use App\Livewire\Sppd\SppdIndex;
use App\Livewire\Surat\SuratMasuk;
use App\Livewire\Surat\SuratKeluar;
use Illuminate\Support\Facades\File;
use App\Livewire\Pegawai\DataPegawai;
use Illuminate\Support\Facades\Route;
use App\Livewire\Surat\SuratMasukIndex;
use App\Livewire\Surat\SuratKeluarIndex;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WordController;
use App\Livewire\Sppd\SppdDetail;

Route::get('/word', function () {
    return view('word');
});

Route::post('word', [WordController::class, 'index'])->name('word.index');



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

Route::get('/', function () {
    return view('livewire.welcome');
})->name('index');

Route::post('/logins', [LoginController::class, 'login'])->name('logins');
Route::get('dashboard', Dashboard::class)->name('dashboard');
Route::get('sppd/{id?}', Sppd::class)->name('sppd');
Route::get('sppd/{id?}/laporan', Sppd::class)->name('sppd-laporan');
Route::get('sppd/{id?}/detail', SppdDetail::class)->name('sppd-detail');
Route::get('sppd-index', SppdIndex::class)->name('sppd-index');
Route::get('suratmasuk/{id?}', SuratMasuk::class)->name('suratmasuk')->middleware('can:sekretariat');
Route::get('suratmasuk/{id?}/disposisi', SuratMasuk::class)->name('suratmasuk-disposisi');
Route::get('suratmasuk-index', SuratMasukIndex::class)->name('suratmasuk-index');
Route::get('suratkeluar/{id?}', SuratKeluar::class)->name('suratkeluar');
Route::get('suratkeluar/{id?}/verifikasi', SuratKeluar::class)->name('suratkeluar-verifikasi');
Route::get('suratkeluar-index', SuratKeluarIndex::class)->name('suratkeluar-index');
Route::get('datapegawai', DataPegawai::class)->name('datapegawai');

Route::get('/word', function () {
    return view('word');
})->name('word');

Route::post('/word-index', [WordController::class, 'index'])->name('word.index');
Route::post('/word-convert', [WordController::class, 'convertToPdf'])->name('word.convert');

// Route::post('/send-whatsapp', [SuratMasuk::class, 'sendWhatsApp'])->name('send.whatsapp');


Route::get('docs', function () {
    return File::get(public_path() . '/documentation.html');
});

Route::group(['middleware' => ['auth']], function () {
    // Route::get('dashboard', Dashboard::class)->name('dashboard');
    // Route::get('sppd', Sppd::class)->name('sppd');
    // Route::get('sppd-index', SppdIndex::class)->name('sppd-index');
    // Route::get('suratMasuk', SuratMasuk::class)->name('suratMasuk');
});
