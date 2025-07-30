<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParameterSeranganController;
use App\Http\Controllers\AttackServerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecentAttackController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/settings', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::patch('/dashboard/settings', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/settings', [DashboardController::class, 'destroy'])->name('dashboard.destroy');


    //detail serangan
    Route::get('/attack/{id}', [AttackServerController::class, 'show'])->name('attack.show');

    //attack server
    Route::get('/attack-server', [AttackServerController::class, 'index'])->name('attack-server.index');
    Route::get('/attack-server/create', [AttackServerController::class, 'create'])->name('attack-server.create');
    Route::post('/attack-server', [AttackServerController::class, 'store'])->name('attack-server.store');
    
    //parameter serangan
    Route::get('/attack-server/{attack}', [AttackServerController::class, 'show'])->name('attack.show');
    Route::post('/attack-server/{attack}/execute', [AttackServerController::class, 'execute'])->name('attack-server.execute');

    //recent attack
    Route::get('/recent-attacks', [RecentAttackController::class, 'index'])->name('recent-attacks');
    Route::post('/filter-attacks', [RecentAttackController::class, 'filter'])->name('attacks.filter');

});

require __DIR__.'/auth.php';
