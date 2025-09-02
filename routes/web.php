<?php

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\EscortRequestController;
use App\Http\Controllers\Admin\EscortRequestController as AdminEscortRequestController;

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

    // Routes pour la gestion des demandes d'escorte (backend)
    Route::resource('escort-requests', AdminEscortRequestController::class);
    Route::get('escort-requests/{escortRequest}/download', [AdminEscortRequestController::class, 'downloadDocument'])->name('escort-requests.download');
    Route::get('escort-requests/{escortRequest}/pdf', [AdminEscortRequestController::class, 'generatePdf'])->name('escort-requests.pdf');
    Route::patch('escort-requests/{escortRequest}/status', [AdminEscortRequestController::class, 'updateStatus'])->name('escort-requests.update-status');

});
