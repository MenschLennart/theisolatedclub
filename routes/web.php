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

// HOME
Route::get('/', 'HomeController@getActivities')->name('home');
Route::post('/add', 'HomeController@addActivity');

// Profile
Route::get('/user/{id}/activities', 'ProfileController@showActivities');

Auth::routes(['register' => false]);
