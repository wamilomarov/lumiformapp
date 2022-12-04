<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\RequestLogsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'log_requests'], function () {
    Route::apiResource('form', FormController::class)
        ->parameters(['form' => 'checklist'])
        ->only(['store', 'show']);

    Route::post('questionnaire', [FormController::class, 'answer']);
});

Route::apiResource('analytics', RequestLogsController::class)->only(['index']);


