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

/*
SCRIPTS PHP
*/
Route::get('/actualizarNombresClientes', 'ScriptsController@actualizarNombresClientes');
Route::get('/test_timezone', 'ScriptsController@test_timezone');
Route::get('/report_deliveries', 'ScriptsController@report_deliveries');


/*
APP METHODS
*/
Route::post('/getOrders', 'OrdersController@getOrders');
Route::post('/getOrderDetail', 'OrdersController@getOrderDetail');
//Payment methos
Route::post('/paymentOpenpayCards', 'OrdersController@paymentOpenpayCards');
Route::post('/paymentOpenpaySpei', 'OrdersController@paymentOpenpaySpei');
Route::post('/paymentOpenpayStore', 'OrdersController@paymentOpenpayStore');
Route::get('/downloadVoucher', 'OrdersController@downloadVoucher');


Route::post('/loginApp', 'UsersController@loginApp');
Route::post('/saveAddress', 'UsersController@saveAddress');
Route::post('/savePhone', 'UsersController@savePhone');
Route::post('/saveNewPassword', 'UsersController@saveNewPassword');

Route::post('/getDeliveries', 'DeliveriesController@getDeliveries');
Route::post('/saveDeliveryCompleted', 'DeliveriesController@saveDeliveryCompleted');

Route::post('/getHarvests', 'HarvestController@getHarvests');
Route::post('/saveHarvestCompleted', 'HarvestController@saveHarvestCompleted');

//Route::post('/getDetailOrder', 'OrdersController@getDetailOrder');



Route::get('/pendingDeliveries', 'DeliveriesController@pendingDeliveries');

Route::get('/ajust_deliveries', 'api\ApiController@ajust_deliveries');