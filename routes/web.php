<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParameterSeranganController;
use App\Http\AttackServerController;
use Illuminate\Support\Facades\Route;
use App\Http\AttackMonitoringController;
use App\Http\Controllers\UserController;

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

    //attack server
    Route::get('/attack-server', [AttackServerController::class, 'index'])->name('attack-server.index');
    Route::get('/attack-server/create', [AttackServerController::class, 'create'])->name('attack-server.create');
    Route::post('/attack-server', [AttackServerController::class, 'store'])->name('attack-server.store');

    // parameter serangan
    Route::get('/parameter-serangan', [ParameterSeranganController::class, 'index'])->name('parameter.serangan');
    Route::post('/parameter-serangan', [ParameterSeranganController::class, 'store'])->name('parameter.serangan.store');

    //detail serangan
    Route::get('/attack/{id}', [AttackServerController::class, 'show'])->name('attack.show');

    //recent attack
    Route::get('/recent-attacks', [AttackMonitoringController::class, 'index'])->name('recent-attacks');
    Route::post('/filter-attacks', [AttackMonitoringController::class, 'filter'])->name('attacks.filter');

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
