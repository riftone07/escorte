<?php

use App\Http\Controllers\Api\AUTH\AuthAPIController;
use App\Http\Controllers\API\AUTH\ForgotPasswordController;
use App\Http\Controllers\API\AUTH\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\VersionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login', [AuthAPIController::class, 'login']);

Route::post('register', [AuthAPIController::class, 'register']);

Route::post('login-number', [AuthAPIController::class, 'loginnumber']);


Route::post('password-reset', [ForgotPasswordController::class,'sendResetLinkResponse']);

Route::post('password-update', [ResetPasswordController::class,'passwordupdate']);


Route::get('versions', [VersionController::class, 'getVersion']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('devices', [DeviceController::class, 'register']);
    Route::post('/devices/unregister', [DeviceController::class, 'unregister']);
});
