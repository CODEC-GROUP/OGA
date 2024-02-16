<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/contact', [ContactController::class, 'contact']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/categories/{category}', [ProjectCategoryController::class, 'update']);
    Route::apiResource('categories', ProjectCategoryController::class)->except('update');
    Route::post('/users/update/{user}', [AuthController::class, 'update']);
    Route::apiResource('/settings', SettingController::class)->only(['update', 'show']);
});

Route::apiResource('contacts', ContactController::class);
