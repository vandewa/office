<?php

use App\Livewire\Coba;
use App\Livewire\Login;
use App\Livewire\Dashboard;
use App\Livewire\Sppd\Sppd;
use App\Livewire\Master\Ssh;
use App\Livewire\Sppd\SppdEdit;
use App\Livewire\Sppd\SppdIndex;
use App\Livewire\Opd\InformasiOpd;
use App\Livewire\Sppd\LaporanSppd;
use App\Livewire\Sppd\SppdKepala;
use App\Livewire\Surat\Disposisi;
use App\Livewire\Surat\SuratMasuk;
use App\Livewire\Surat\SuratMasukIndex;
use Illuminate\Support\Facades\File;
use App\Livewire\Pegawai\DataPegawai;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HelperController;
use App\Livewire\Agenda\Agenda;
use App\Livewire\Agenda\FrontAgenda;
use App\Livewire\Tamu\DataTamu;
use App\Livewire\Tamu\MandiriTamu;

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
Route::middleware([
    'auth:web'
])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('sppd/{id?}', Sppd::class)->name('sppd');
    Route::get('sppd-kepala/{id?}', SppdKepala::class)->name('sppd-kepala');
    Route::get('sppd-index', SppdIndex::class)->name('sppd-index');
    Route::get('surat-masuk/{id?}', SuratMasuk::class)->name('suratmasuk');
    Route::get('surat-masuk-index', SuratMasukIndex::class)->name('suratmasuk-index');
    Route::get('datapegawai', DataPegawai::class)->name('datapegawai');
    Route::get('laporan-sppd/{id?}', LaporanSppd::class)->name('laporan-sppd');
    Route::get('informasi-opd', InformasiOpd::class)->name('informasi-opd');
    Route::get('disposisi/{id?}', Disposisi::class)->name('disposisi');
    Route::get('agenda', Agenda::class)->name('agenda');
    Route::get('front-agenda', FrontAgenda::class)->name('front.agenda');
    //cetak
    Route::get('/cetak-spt/{id?}', [HelperController::class, 'cetakSPT'])->name('cetak-spt');
    Route::get('/cetak-spt-kepala/{id?}', [HelperController::class, 'cetakSPTKepala'])->name('cetak-spt-kepala');
    Route::get('/cetak-sppd/{parameter1}/{parameter2}', [HelperController::class, 'cetakSPPD'])->name('cetak-sppd');
    Route::get('/cetak-sppd-kepala/{parameter1}/{parameter2}', [HelperController::class, 'cetakSPPDKepala'])->name('cetak-sppd-kepala');
    Route::get('/cetak-laporan-sppd/{id?}', [HelperController::class, 'cetakLaporanSPPD'])->name('cetak-laporan-sppd');

    //helper
    Route::get('show-picture', [HelperController::class, 'showPicture'])->name('helper.show-picture');

    Route::get('/data-tamu', DataTamu::class)->name('data-tamu');
    Route::get('/tamu-mandiri', MandiriTamu::class)->name('tamu-mandiri');

    Route::get('logout', [HelperController::class, 'logout'])->name('logout');
});
Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
    Route::get('ssh', Ssh::class)->name('ssh');
});

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
