<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\DoctorAuthController;
use App\Http\Controllers\Api\Auth\PatientAuthController;
use App\Http\Controllers\Api\Actors\Doctor\DoctorController;
use App\Http\Controllers\Api\Actors\Patient\PatientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Doctor routes (Public API routes)
Route::prefix('auth')->group(function () {
    Route::post('doctors/register', [DoctorAuthController::class, 'register']);
    Route::post('doctors/login', [DoctorAuthController::class, 'login']);
    Route::post('doctors/forgot-password', [DoctorAuthController::class, 'storeReset']);
    Route::post('doctors/forgot-password/{token}', [DoctorAuthController::class, 'resetPassword']);

    // Route::post('/forgot-password', [DoctorAuthController::class, 'store']);
    // Route::post('/forgot-password/{token}', [DoctorAuthController::class, 'reset']);
});


// Use custom middleware to check user role (Protected API routes)
Route::group(['middleware' => ['auth:sanctum_doctors', 'role:doctor']], function () {
    Route::post('doctors/logout', [DoctorAuthController::class, 'logout']);
    Route::apiResource('doctors', DoctorController::class);
});

Route::group(['middleware' => ['throttle:5,1', 'role:doctor']], function () {
    Route::post('password/email', [DoctorAuthController::class, 'sendPasswordResetLinkEmail']);
});

// Patient routes (Public API routes)
Route::prefix('auth')->group(function () {
    Route::post('patients/register', [PatientAuthController::class, 'register']);
    Route::post('patients/login', [PatientAuthController::class, 'login']);
    Route::post('patients/password/reset', [PatientAuthController::class, 'resetPassword']);
});

// Use custom middleware to check user role (Protected API routes)
Route::group(['middleware' => ['auth:sanctum_patients', 'role:patient']], function () {
    Route::post('patients/logout', [PatientAuthController::class, 'logout']);
    Route::apiResource('patients', PatientController::class);
});

Route::group(['middleware' => ['throttle:5,1', 'role:patient']], function () {
    Route::post('password/email', [PatientAuthController::class, 'sendPasswordResetLinkEmail']);
});
