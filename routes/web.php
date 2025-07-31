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

    //user management
    Route::get('/user-management', [App\Http\Controllers\UserController::class, 'index'])->name('user-management');

    //user management add
    Route::get('/user-management-add', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get ('users/{user}/roles', [RoleController::class,'assignRoleForm'])
                ->name('users.roles.edit');
            Route::post('users/{user}/roles', [RoleController::class,'assignRole'])
                ->name('users.roles.update');

            Route::resource('roles', RoleController::class);
});

require __DIR__.'/auth.php';
