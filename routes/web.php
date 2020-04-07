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

// HOME
Route::get('/', 'ActivityController@index')->name('home');

// Activity
Route::resource('activities', 'ActivityController');

// Category
Route::resource('categories', 'CategoryController');

// Profile
Route::get('/user/{id}/activities', 'UserController@showUserActivities')->name('userActivities');
Route::get('/profile/activities', 'ProfileController@indexActivities')->name('myActivities');

Auth::routes();
