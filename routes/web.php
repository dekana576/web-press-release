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
    Route::get('/press-data', [PressReleaseController::class, 'getPress'])->name('data.press');

    Route::get('/data/create', [PressReleaseController::class, 'create'])->name('data.create');
    Route::post('/data/store', [PressReleaseController::class, 'store'])->name('data.store');
    Route::post('/image-upload', [PressReleaseController::class, 'uploadImage'])->name('image.upload');

    Route::get('/data/{id}/edit', [PressReleaseController::class, 'edit'])->name('data.edit');
    Route::put('/data/{id}', [PressReleaseController::class, 'update'])->name('data.update');

    Route::get('/data/{id}/view', [PressReleaseController::class, 'show'])->name('data.view');
    Route::delete('/data/{id}/delete', [PressReleaseController::class, 'destroy'])->name('data.delete');
});
