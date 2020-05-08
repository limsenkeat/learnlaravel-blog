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

Route::get('/', function () {

    // $user = User::findOrFail(12);
    // echo $user->password;
    // echo '<br>';
    // echo bcrypt('123123123');
    // dd(Auth::attempt(array('email' => 'keat_09@hotmail.com', 'password' => '123123123')));

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin');

Route::group(['middleware' => 'admin'], function () {

    Route::resource('admin/users', 'AdminUsersController', [
        'as' => 'admin'
    ]);

});
