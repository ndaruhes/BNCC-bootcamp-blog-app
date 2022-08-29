<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('/blog/all', 'App\Http\Controllers\PageController@allBlog')->name('getAllBlog');


Route::group(['middleware' => 'RoleAdmin'], function () {
    // CATEGORY ROUTES
    Route::get('/category', 'App\Http\Controllers\CategoryController@index');
    Route::post('/category', 'App\Http\Controllers\CategoryController@store')->name('storeCategory');
    Route::get('/category/{id}', 'App\Http\Controllers\CategoryController@edit')->name('editCategory');
    Route::put('/category/{id}', 'App\Http\Controllers\CategoryController@update')->name('updateCategory');
    Route::delete('/category/{id}', 'App\Http\Controllers\CategoryController@destroy')->name('deleteCategory');
});


// BLOG ROUTES
Route::get('/blog', 'App\Http\Controllers\BlogController@index');
Route::post('/blog', 'App\Http\Controllers\BlogController@store')->name('storeBlog');
Route::get('/blog/{id}', 'App\Http\Controllers\BlogController@edit')->name('editBlog');
Route::put('/blog/{id}', 'App\Http\Controllers\BlogController@update')->name('updateBlog');
Route::delete('/blog/{id}', 'App\Http\Controllers\BlogController@destroy')->name('deleteBlog');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
