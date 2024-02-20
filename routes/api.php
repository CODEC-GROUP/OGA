<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\SettingController;
use App\Models\Person;
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

Route::middleware('auth:sanctum')->group(function () {

//route to manage categories
Route::post('/categories/{category}', [ProjectCategoryController::class, 'update']); //index,store,show and destroy categories
Route::apiResource('categories', ProjectCategoryController::class)->except('update'); //update categories



//routes to manage posts
Route::apiResource('posts', PostController::class)->except('update'); //index,store,show and destroy posts
Route::post('/posts/{post}', [PostController::class, 'update']); //update post

//routes to manage person
Route::apiResource('persons', PersonController::class); //index,store,show,update and destroy persons



//route to update user loged
Route::post('/users/update/{user}', [AuthController::class, 'update']); //update user



//route to manage settings
Route::apiResource('/settings', SettingController::class)->only(['update', 'show']); //show and update settings
});

//route to manage settings
Route::apiResource('contacts', ContactController::class)->except('store', 'update'); //index,show and destroy 
Route::post('/contact', [ContactController::class, 'contact']); //store and send message
