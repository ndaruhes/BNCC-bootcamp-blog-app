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


Route::group(['namespace', 'App\Http\Controllers'], function () {
    Route::get('/blog/all', 'PageController@allBlog')->name('getAllBlog');
    
    Route::group(['middleware' => 'RoleAdmin'], function () {
        // CATEGORY ROUTES
        Route::get('/category', 'CategoryController@index');
        Route::post('/category', 'CategoryController@store')->name('storeCategory');
        Route::get('/category/{id}', 'CategoryController@edit')->name('editCategory');
        Route::put('/category/{id}', 'CategoryController@update')->name('updateCategory');
        Route::delete('/category/{id}', 'CategoryController@destroy')->name('deleteCategory');

        // ACCEPT BLOG
        Route::put('/blog/accept/{id}', 'BlogController@acceptBlog')->name('acceptBlog');
    });


    // BLOG ROUTES
    Route::get('/blog', 'BlogController@index');
    Route::post('/blog', 'BlogController@store')->name('storeBlog');
    Route::get('/blog/{id}', 'BlogController@edit')->name('editBlog');
    Route::put('/blog/{id}', 'BlogController@update')->name('updateBlog');
    Route::delete('/blog/{id}', 'BlogController@destroy')->name('deleteBlog');

    // SEARCH BLOG
    Route::post('/blog/search', 'BlogController@search')->name('searchBlog');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
