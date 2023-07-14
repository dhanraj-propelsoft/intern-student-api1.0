<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MarkController;




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
Route::apiResource('/student',StudentController::class);
Route::post('/student/{id}',[StudentController::class,'update']);
Route::apiResource('/exam',ExamController::class);
Route::post('/exam/{id}',[ExamController::class,'update']);
Route::apiResource('/subject',SubjectController::class);
Route::post('/subject/{id}',[SubjectController::class,'update']);
Route::apiResource('/mark',MarkController::class);
Route::post('/mark/{id}',[MarkController::class,'update']);




