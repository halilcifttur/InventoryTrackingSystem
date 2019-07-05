<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth','admin']], function() {

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::post('register', 'UserRegisterController@store');
	Route::resource('destroy', 'DashboardController');
	
});

Route::group(['as' => 'teacher.', 'prefix' => 'teacher', 'namespace' => 'Teacher', 'middleware' => ['auth','teacher']], function() {

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::post('appointment', 'AddAppointmentController@store')->name('appointment');
	Route::resource('destroy', 'DashboardController');
	
});

Route::group(['as' => 'student.', 'prefix' => 'student', 'namespace' => 'Student', 'middleware' => ['auth','student']], function() {

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});