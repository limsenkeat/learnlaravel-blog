<?php

use App\User;
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

Auth::routes();
// Route::get('/', function(){
//     return Hash::make(123123123);
// })->name('home');

//home page
Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{id}', 'PostController@show')->name('post');

//admin route
Route::group(['middleware' => 'admin'], function () {


    //admin main
    Route::get('/admin', 'AdminsController@index')->name('admin.index');

    //user
    Route::resource('admin/users', 'AdminUsersController', [
        'as' => 'admin'
    ]);

    //posts
    Route::resource('admin/posts', 'AdminPostsController', [
        'as' => 'admin'
    ]);

    //categories
    Route::resource('admin/categories', 'AdminCategoriesController', [
        'as' => 'admin'
    ]);

});
