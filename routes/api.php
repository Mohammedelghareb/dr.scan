<?php

use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\PhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Medium;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[PassportAuthController::class,'register']);
Route::post('login',[PassportAuthController::class,'login']);
Route::get('userInfo',[PassportAuthController::class,'userInfo']);
Route::post('logout',[PassportAuthController::class,'logout']);

Route::post('save_photo',[PhotoController::class,'uploadPhoto'])->middleware('auth:api');
Route::get('photo_result',[PhotoController::class,'show']);

Route::post('save_diagnosis', [DiagnosisController::class, 'create'])->middleware('auth:api');
Route::get('diagnosis_result',[DiagnosisController::class,'index']);




