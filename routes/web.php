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

Route::get('/', 'AnasayfaController@index')->name('anasayfa');

Auth::routes();

Route::get('/deneme', function() {

	return view('deneme');
});

Route::prefix('admin')->group(function() {

	Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/dashboard','Admin\AdminController@index')->name('admin.dashboard');
	Route::get('/liste','Admin\AdminController@ajax')->name('admin.liste');
	Route::post('register', 'Admin\AddUserController@store');
	Route::post('sirket', 'Admin\AddSirketController@store')->name('sirket');

	Route::get('/getSirket/{sirket_id}','Admin\AdminController@getSirket');
	Route::get('/getIlce/{il_no}','Admin\AdminController@getIlce');
	Route::get('/getUser/{user_id}','Admin\AdminController@getUser');

	Route::post('/kaydet/{companyId}','Admin\AdminController@update');
	Route::post('/userKaydet/{userID}','Admin\AdminController@update2');
	
	Route::resource('destroy', 'Admin\AdminController');
	Route::post('destroy2', 'Admin\AdminController@destroy2');

});

Route::group(['as' => 'sirket.', 'prefix' => 'sirket', 'namespace' => 'Sirket', 'middleware' => ['auth','sirket']], function() {

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('liste', 'DashboardController@ajax')->name('liste');

	Route::post('register', 'AddUserController@store');
	Route::post('depo', 'AddDepoController@store')->name('depo');
	
	Route::resource('destroy', 'DashboardController');
	Route::post('destroy2', 'DashboardController@destroy2');
	Route::post('destroy3', 'DashboardController@destroy3');
	
	Route::get('getIlce/{il_no}','DashboardController@getIlce')->name('sirket.ilce');
	Route::get('customers', 'ListeController@getCustomers')->name('liste.index');
});

Route::group(['as' => 'calisan.','prefix' => 'calisan','namespace' => 'Calisan', 'middleware' => ['auth','calisan']], function() {

	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::post('urun', 'AddUrunController@store')->name('urun');
	Route::resource('destroy', 'DashboardController');
});