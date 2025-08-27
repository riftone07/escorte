<?php

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\EscortRequestController;

Route::get('/', function () {
    return view('welcome');
});

// Routes publiques pour les demandes d'escorte
Route::prefix('demande-escorte')->name('front.')->group(function () {
    Route::get('/', [EscortRequestController::class, 'create'])->name('reclamation.create');
    Route::post('/', [EscortRequestController::class, 'store'])->name('reclamations.storePublic');
});

Route::group(['prefix' => 'admin','as' => 'admin.','middleware' => ['auth:sanctum',config('jetstream.auth_session')]], function () {

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionsController::class);

    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    
    // Routes pour la gestion des versions
    Route::get('versions', [VersionController::class, 'index'])->name('versions.index');
    Route::get('versions/create', [VersionController::class, 'create'])->name('versions.create');
    Route::post('versions', [VersionController::class, 'store'])->name('versions.store');
    Route::get('versions/edit', [VersionController::class, 'edit'])->name('versions.edit');
    Route::put('versions', [VersionController::class, 'update'])->name('versions.update');
    Route::delete('versions', [VersionController::class, 'destroy'])->name('versions.destroy');

});
