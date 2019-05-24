<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');
Route::group(['middleware' => 'jwt.auth'], function(){
	Route::get('auth/user', 'AuthController@user');
	Route::post('auth/logout', 'AuthController@logout');
	Route::get('/addresses', 'AddressController@index');
	Route::get('/addresses/{id}', 'AddressController@show');	
	Route::post('/addAddress', 'AddressController@store');	
	Route::put('/editAddress/{id}','AddressController@update');
	Route::delete('/deleteAddress/{id}', 'AddressController@destroy');		
	Route::post('/addInvoice', 'InvoiceController@store');
	Route::get('/invoices', 'InvoiceController@index');		
	Route::get('/invoices/{id}', 'InvoiceController@show');			
	Route::delete('/deleteInvoice/{id}', 'InvoiceController@destroy');		
	Route::put('/editInvoice/{id}','InvoiceController@update');		
	
	
});
Route::group(['middleware' => 'jwt.refresh'], function(){
	Route::get('auth/refresh', 'AuthController@refresh');
});


