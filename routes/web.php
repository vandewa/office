<?php

use App\Http\Controllers\LoginController;
use App\Livewire\Coba;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\Pegawai\DataPegawai;
use App\Livewire\Sppd\Sppd;
use App\Livewire\Sppd\SppdEdit;
use App\Livewire\Sppd\SppdIndex;
use App\Livewire\Surat\SuratMasuk;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;


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
Route::get('sppd', Sppd::class)->name('sppd');
Route::get('sppd-index', SppdIndex::class)->name('sppd-index');
Route::get('/sppd/{id}/edit', SppdEdit::class)->name('sppd-edit');
Route::get('suratMasuk', SuratMasuk::class)->name('suratMasuk');
Route::get('dataPegawai', DataPegawai::class)->name('dataPegawai');



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
