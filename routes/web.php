<?php

use App\Livewire\Coba;
use App\Livewire\Login;
use App\Models\Document;
use App\Livewire\Dashboard;
use App\Livewire\Sppd\Sppd;
use App\Livewire\ConvertToPdf;
use App\Livewire\Sppd\SppdEdit;
use App\Livewire\Sppd\SppdIndex;
use App\Livewire\Sppd\SppdDetail;
use App\Livewire\Surat\SuratMasuk;
use App\Livewire\Surat\SuratKeluar;
use Illuminate\Support\Facades\File;
use App\Livewire\Component\Signature;
use App\Livewire\Pegawai\DataPegawai;
use App\Livewire\Surat\UnggahDokumen;
use Illuminate\Support\Facades\Route;
use App\Livewire\Surat\SuratMasukIndex;
use App\Http\Controllers\SppdController;
use App\Http\Controllers\WordController;
use App\Livewire\Surat\SuratKeluarIndex;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\SIgnatureController;
use App\Http\Controllers\UnggahDokumenController;
use App\Models\Sppd as ModelsSppd;

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
Route::get('sppd-index', SppdIndex::class)->name('sppd-index');
Route::get('sppd/{id}/print-spt', [SppdController::class, 'printSpt'])->name('print-spt');

Route::get('/download-spt', [Sppd::class, 'downloadSpt'])->name('download.spt');
// Route::get('/download-dokumen/{nip}', [Sppd::class, 'downloadDokumen'])->name('download.dokumen');

// Route::get('sppd/{id}/print-spt-kadin', [SppdController::class, 'printsptkadin'])->name('print-spt-kadin');
Route::get('sppd/{id}/print-spd', [SppdController::class, 'printspd'])->name('print-spd');
// Route::get('sppd/{id}/print-spd-kadin', [SppdController::class, 'printspdkadin'])->name('print-spd-kadin');

Route::get('suratmasuk/{id?}', SuratMasuk::class)->name('suratmasuk')->middleware('can:sekretariat');
Route::get('suratmasuk/{id?}/disposisi', SuratMasuk::class)->name('suratmasuk-disposisi');
Route::get('suratmasuk-index', SuratMasukIndex::class)->name('suratmasuk-index');

Route::get('suratkeluar/{id?}', SuratKeluar::class)->name('suratkeluar')->middleware('can:sekretariat');
Route::get('suratkeluar/{id?}/verifikasi', SuratKeluar::class)->name('suratkeluar-verifikasi');
Route::get('suratkeluar-index', SuratKeluarIndex::class)->name('suratkeluar-index');
Route::get('suratkeluar/{id}/download', [SuratKeluar::class, 'downloadDokumen'])->name('suratkeluar-download');

Route::get('/download-spt', [Sppd::class, 'downloadSpt'])->name('download.spt');
Route::get('/download-dokumen/{nip}', [Sppd::class, 'downloadDokumen'])->name('download.dokumen');



Route::get('suratkeluar/{id}/print-suratkeluar', [SuratController::class, 'generateOrRenderSuratKeluar'])->name('print-suratkeluar');

Route::get('datapegawai', DataPegawai::class)->name('datapegawai');

Route::get('/unggah-dokumen', [UnggahDokumenController::class, 'create'])->name('unggah-dokumen.create');
Route::post('/unggah-dokumen', [UnggahDokumenController::class, 'store'])->name('unggah-dokumen.store');
Route::get('/preview-dokumen/{id}', [UnggahDokumenController::class, 'preview'])->name('dokumen.preview');
Route::get('/tampilkan-dokumen/{id}', [UnggahDokumenController::class, 'show'])->name('tampilkan-dokumen.show');
Route::get('/tampilkan-dokumen/{id}/suratkeluar', [UnggahDokumenController::class, 'showKeluar'])->name('tampilkan-dokumen.showkeluar');
Route::post('/documents/upload/{suratKeluarId}', [UnggahDokumenController::class, 'storeKeluar'])->name('documents.upload');


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
