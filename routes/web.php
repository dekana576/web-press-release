<?php

use App\Http\Controllers\PressReleaseController;
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



// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [PressReleaseController::class, 'index'])->name('dashboard');
    Route::get('/press-release', [PressReleaseController::class, 'pressIndex'])->name('press_release');
    Route::get('/data/create', [PressReleaseController::class, 'create'])->name('data.create');
    Route::post('/data/store', [PressReleaseController::class, 'store'])->name('data.store');
});
