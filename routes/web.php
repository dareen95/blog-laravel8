<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/categories', 'CategoriesController');
Route::resource('/tags', 'TagsController');
Route::resource('/posts', 'PostsController');
Route::get('/trashed-posts', 'PostsController@trashed')->name('trashed.index');
Route::get('/trashed-posts/{id}', 'PostsController@restore')->name('trashed.restore');

Route::middleware(['auth', 'admin'])->group(function() {
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/users', 'UsersController@index')->name('users.index');
Route::post('/users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});

Route::middleware(['auth'])->group(function() {
Route::get('/users/{user}/profile', 'UsersController@edit')->name('users.edit');
Route::post('/users/{user}/profile', 'UsersController@update')->name('users.update');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
