<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParameterSeranganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // parameter serangan
    Route::get('/parameter-serangan', [ParameterSeranganController::class, 'index'])->name('parameter.serangan');
    Route::post('/parameter-serangan', [ParameterSeranganController::class, 'kirim'])->name('parameter.serangan.kirim');

});

require __DIR__.'/auth.php';
