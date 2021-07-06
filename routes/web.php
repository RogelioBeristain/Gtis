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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('product/find/{code}','ProductController@find')->name('product.find');
Route::get('product/count','ProductController@count')->name('product.count');
Route::resource('product', 'ProductController');
Route::get('client/{client}/edit.json','ClientController@editJson')->name('client.editJson');
Route::post('client/send','ClientController@send')->name('client.send');
Route::post('client/warranty','ClientController@warranty')->name('client.warranty');
Route::get('client/home','ClientController@home')->name('client.home');
Route::get('client/count','ClientController@count')->name('client.count');
Route::get('client/solicitudes','ClientController@mesa')->name('client.mesa');
Route::resource('client', 'ClientController');
Route::get('manufacturer/count','ManufacturerController@count')->name('manufacturer.count');
Route::resource('manufacturer', 'ManufacturerController');
Route::get('wholesaler/count','WholesalerController@count')->name('wholesaler.count');
Route::resource('wholesaler', 'WholesalerController');
Route::get('kit/count','KitController@count')->name('kit.count');
Route::get('kit/find/{code}','KitController@find')->name('kit.find');
Route::get('kit/{kit}/edit.json','KitController@editJson')->name('kit.editJson');
Route::resource('kit', 'KitController');
Route::get('/rate/print-pdf','RateController@printPDF') ->name ('rate.printpdf');
Route::post('rate/verPDF','RateController@verPDF')->name('rate.verPDF');
Route::get('rate/{rate}/edit.json','RateController@editJson')->name('rate.editJson');
Route::get('rate/count','RateController@count')->name('rate.count');
Route::get('rate/createvue','RateController@createvue')->name('rate.createvue');
Route::get('rate/vista-previa/{cotizacion}','RateController@vistaPrevia')->name('rate.vistaPrevia');
Route::post('rate/vista-previa-crete/','RateController@createVistaPrevia')->name('rate.createVistaPrevia');
Route::post('rate/saveAndSend','RateController@saveAndSend')->name('rate.saveAndSend');
Route::post('rate/mailSend','RateController@mailSend')->name('rate.mailSend');
Route::resource('rate', 'RateController');
Route::post('remission/saveAndSend','RemissionController@saveAndSend')->name('remission.saveAndSend');
Route::resource('remission', 'RemissionController');
Route::post('/user/profile/photo', 'UserController@photo')->name('user.profile.photo');
Route::get('user/count','UserController@count')->name('user.count');
Route::get('/user/{id}', 'UserController@profile')->name('user.profile');
Route::get('/users/all', 'UserController@all')->name('users.all');
Route::get('/users/solicitudes', 'UserController@solicitudes')->name('users.solicitudes');
Route::resource('user', 'UserController');
Route::resource('roles','RoleController');

Route::get('/foo', function () {
Artisan::call('migrate');
});

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
}); 

 Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});
