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

// Route::group(['middleware' => 'RoleAdmin'], function () {
//     Route::get('/admin', function () {
//         return 'Halo admin';
//     });
// });

// Route::group(['middleware' => 'RoleMember'], function () {
//     Route::get('/member', function () {
//         return 'Halo member';
//     });
// });


Route::group(['middleware' => 'RoleAdmin'], function () {
    // CATEGORY ROUTES
    Route::get('/category', 'App\Http\Controllers\CategoryController@index');
    Route::post('/category', 'App\Http\Controllers\CategoryController@store')->name('storeCategory');
    Route::get('/category/{id}', 'App\Http\Controllers\CategoryController@edit')->name('editCategory');
    Route::put('/category/{id}', 'App\Http\Controllers\CategoryController@update')->name('updateCategory');
    Route::delete('/category/{id}', 'App\Http\Controllers\CategoryController@destroy')->name('deleteCategory');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
