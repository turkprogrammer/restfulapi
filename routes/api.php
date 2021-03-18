<?php

use App\Http\Controllers\Api\Country\CountryController;
use App\Http\Controllers\Api\Auth\LoginController;
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

Route::get('country', [CountryController::class, 'country']);
Route::get('country/{id}', [CountryController::class, 'countryById']);
Route::post('country', [CountryController::class, 'countrySave']);
Route::put('country/{country}', [CountryController::class, 'countryEdit']);
Route::delete('country/{country}', [CountryController::class, 'countryDelete']);
Route::post('login', [LoginController::class, 'login']);
