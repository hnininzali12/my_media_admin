<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminListController;
use App\Http\Controllers\TrendPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.profile.index');
    // })->name('dashboard');
    //profile
    Route::get('/dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'updateAdminAcc'])->name('admin#update');
    Route::get('admin/changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');
    Route::post('admin/updatePassword',[ProfileController::class,'updatePassword'])->name('admin#updatePassword');

    //admin list
    Route::get('admin/list',[AdminListController::class,'index'])->name('admin#list');
    Route::get('admin/list/delete,{id}',[AdminListController::class,'deleteAcc'])->name('admin#deleteAcc');
    Route::get('admin/searchAdminList',[AdminListController::class,'searchAdminList'])->name('admin#searchAdminList');

    //category
    Route::get('admin/category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('admin/category/create',[CategoryController::class,'categoryCreate'])->name('admin#categoryCreate');
    Route::get('admin/category/delete,{id}',[CategoryController::class,'categoryDelete'])->name('admin#categoryDelete');
    Route::post('admin/category',[CategoryController::class,'categorySearch'])->name('admin#categorySearch');
    Route::get('admin/category/edit,{id}',[CategoryController::class,'categoryEdit'])->name('admin#categoryEdit');
    Route::post('admin/category/update,{id}',[CategoryController::class,'categoryUpdate'])->name('admin#categoryUpdate');

    //post
    Route::get('admin/post',[PostController::class,'index'])->name('admin#post');
    Route::post('admin/post/create',[PostController::class,'postCreate'])->name('admin#postCreate');
    Route::get('admin/post/delete,{id}',[PostController::class,'postDelete'])->name('admin#postDelete');
    Route::get('admin/post/edit,{id}',[PostController::class,'postEdit'])->name('admin#postEdit');
    Route::post('admin/post/update,{id}',[PostController::class,'postUpdate'])->name('admin#postUpdate');

    //trend post
    Route::get('admin/trend_post',[TrendPostController::class,'index'])->name('admin#trend_post');
    Route::get('admin/trend_post/details,{id}',[TrendPostController::class,'detailsTrendPost'])->name('admin#detailsTrendPost');
});
