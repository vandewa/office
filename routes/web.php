<?php

use App\Livewire\Coba;
use App\Livewire\Sppd;
use App\Livewire\SppdIndex;
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
});

Route::get('/', Coba::class)->name('coba');
Route::get('sppd', Sppd::class)->name('sppd');
Route::get('sppd-index', SppdIndex::class)->name('sppd-index');


Route::get('docs', function () {
    return File::get(public_path() . '/documentation.html');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
