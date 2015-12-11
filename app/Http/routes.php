<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'WelcomeController@index']);

/**
 * Authentication routes.
 */
Route::get('login', ['as' => 'session.create', 'uses' => 'SessionController@create']);
Route::post('login', ['as' => 'session.store', 'uses' => 'SessionController@store']);
Route::get('logout', ['as' => 'session.destroy', 'uses' => 'SessionController@destroy']);

/**
 * Routes that require authentication.
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    Route::resource('attribute', 'AttributeController', ['except' => ['show', 'destroy']]);
    Route::resource('carrier', 'CarrierController', ['except' => ['show', 'destroy']]);
    Route::patch('carrier/{id}/set-default', ['as' => 'carrier.set-default', 'uses' => 'CarrierController@setDefault']);
    Route::resource('country', 'CountryController', ['except' => ['show', 'destroy']]);
    Route::resource('product', 'ProductController', ['except' => ['show']]);
    Route::resource('product-type', 'ProductTypeController', ['except' => ['show', 'destroy']]);
    Route::resource('supplier', 'SupplierController', ['except' => ['show', 'destroy']]);
    Route::resource('shipping-rule', 'ShippingRuleController', ['except' => ['show', 'destroy']]);
    Route::resource('vat-rate', 'VatRateController', ['except' => ['show', 'destroy']]);
});

/**
 * API routes
 */
Route::get('api/{version}/{model}/{action?}', ['as' => 'api.index', 'uses' => 'ApiController@index']);
