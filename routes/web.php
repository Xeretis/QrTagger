<?php

use App\Livewire\TagScannedPage;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('filament.common.auth.login');
});

Route::get('/login', function () {
    return redirect()->route('filament.common.auth.login');
})->name('login');

Route::get('/tag-scanned/{tag:secret}', TagScannedPage::class)->name('tag-scanned');
