<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ReactionController;
use App\Http\Controllers\Api\ActionLogsController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);
Route::get('category',[AuthController::class,'category'])->middleware('auth:sanctum');

Route::get('allPostList',[PostController::class,'allPostList']);
Route::post('post/search',[PostController::class,'searchPost']);
Route::post('post/autocompleteSearch',[PostController::class,'autocompleteSearch']);
Route::post('post/details',[PostController::class,'postDetails']);

Route::get('allCategoryList',[CategoryController::class,'allCategoryList']);
Route::post('category/search',[CategoryController::class,'categorySearch']);

Route::post('actionLogs',[ActionLogsController::class,'setActionLogs']);

Route::post('reaction',[ReactionController::class,'reaction']);
Route::post('reaction/delete',[ReactionController::class,'deleteReaction']);
Route::post('reaction/count',[ReactionController::class,'reactionCount']);
Route::post('comment',[ReactionController::class,'comment']);
Route::post('get/comment',[ReactionController::class,'getComment']);
Route::post('delete/comment',[ReactionController::class,'deleteComment']);
Route::post('update/comment',[ReactionController::class,'updateComment']);
