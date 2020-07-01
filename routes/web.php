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

Route::get('/', 'PagesController@index');
Route::resource('contact', 'ContactController');

Auth::routes();

// Route::get('/contact', 'HomeController@index');
// Route::get('/contact/create', 'Contact_Controller@create');
// Route::get('/contact/create', 'ContactController@store');
Route::resource('contact', 'Contact_Controller');
Route::resource('contact/search', 'Contact_Controller@search');
