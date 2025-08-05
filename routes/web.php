<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttackParameterController;
use App\Http\Controllers\AttackServerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecentAttackController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ManageDosController;
use App\Http\Controllers\SourceServerTypeController;

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
     Route::delete('/attacks/{attack}', [RecentAttackController::class, 'destroy'])->name('attacks.destroy');

    // user management
    Route::resource('users', App\Http\Controllers\UserManagementController::class);

    // --- mengelola DOS Type ---
    Route::prefix('dos-types')->controller(ManageDosController::class)->group(function () {
        Route::get('/', 'index')->name('dos-types.index');
        Route::post('/', 'store')->name('dos-types.store');
        Route::put('/{dosType}', 'update')->name('dos-types.update');
        Route::delete('/{dosType}', 'destroy')->name('dos-types.destroy');
    });

    // Manage Source Server Type
    Route::prefix('source-server-types')->controller(SourceServerTypeController::class)->group(function () {
        Route::get('/', 'index')->name('source-types.index');
        Route::post('/', 'store')->name('source-types.store');
        Route::put('/{sourceServerType}', 'update')->name('source-types.update');
        Route::delete('/{sourceServerType}', 'destroy')->name('source-types.destroy');
    });

});

require __DIR__.'/auth.php';
