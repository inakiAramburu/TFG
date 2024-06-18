<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientSummaryGetController;
use App\Http\Controllers\AllPatientsGetController;

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

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'v1',
    ], function () {

    Route::group(['prefix' => 'patient',], function () {
        Route::get('', AllPatientsGetController::class);
        Route::get('summary/{patient_id}', PatientSummaryGetController::class)->where('patient_id', '[0-9]+');
    });

});