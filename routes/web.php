<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParameterSeranganController;
use App\Http\Controllers\AttackServerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecentAttackController;
use App\Http\Controllers\UserManagementController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/settings', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::patch('/dashboard/settings', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/settings', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

    //attack server
    Route::resource('attack-server', AttackServerController::class)->parameters([
    'attack-server' => 'attack'
]);
    Route::post('/attack-server/{attack}/execute', [AttackServerController::class, 'execute'])->name('attack-server.execute');
    
    //parameter serangan
    Route::get('/attack-server/{attack}', [AttackServerController::class, 'show'])->name('attack.show');
    Route::post('/attack-server/{attack}/execute', [AttackServerController::class, 'execute'])->name('attack-server.execute');

    //recent attack
    Route::get('/recent-attacks', [RecentAttackController::class, 'index'])->name('recent-attacks');
    Route::post('/filter-attacks', [RecentAttackController::class, 'filter'])->name('attacks.filter');

    // user management
    Route::resource('users', App\Http\Controllers\UserManagementController::class);
});

require __DIR__.'/auth.php';
