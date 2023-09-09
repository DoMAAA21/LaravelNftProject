<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('character/index','CharacterController@index');
Route::get('customer/index','CustomerController@index');
Route::get('employee/index','EmployeeController@index');
Route::get('crypto/index','CryptoController@index');








Route::resource('character', 'CharacterController')->middleware('auth:sanctum','verified');
Route::post('character/post/{id}','characterController@update')->middleware('auth:sanctum','verified');


Route::resource('customer', 'CustomerController')->middleware('auth:sanctum','verified');

Route::post('customer/post/{id}','CustomerController@update')->middleware('auth:sanctum','verified');


Route::resource('employee', 'EmployeeController')->middleware('auth:sanctum','verified');
Route::post('employee/post/{id}','EmployeeController@update')->middleware('auth:sanctum','verified');


Route::resource('crypto', 'CryptoController')->middleware('auth:sanctum','verified');
Route::post('crypto/post/{id}','cryptoController@update')->middleware('auth:sanctum','verified');

Route::get('cryptoup','cryptoController@all')->middleware('auth:sanctum','verified');

Route::resource('cryptotransaction', 'CryptoTransactionController')->middleware('auth:sanctum','verified');;

Route::post('logout','LoginController@logout')->middleware('auth:sanctum','verified');
Route::post('login','LoginController@login');
Route::post('refresh','LoginController@refresh');
// Route::get('login','LoginController@showLogin');


Route::post('/item/checkout',[
    'uses' => 'CryptoTransactionController@postCheckout',
    'as' => 'checkout'
])->middleware('auth:sanctum','verified');


Route::post('/citem/ccheckout',[
    'uses' => 'CharacterController@postCheckout',
    'as' => 'ccheckout'
])->middleware('auth:sanctum','verified');


Route::get('/dashboard/sales-chart',[
    'uses' => 'ChartController@salesChart',
    'as' => 'dashboard.salesChart'
]);

Route::get('/dashboard/class-chart',[
    'uses' => 'ChartController@classChart',
    'as' => 'dashboard.classChart'
]);
Route::get('/dashboard/top-chart',[
    'uses' => 'ChartController@topChart',
]);

Route::get('/dashboard/topchar-chart',[
    'uses' => 'ChartController@topcharChart',
]);

Route::get('/dashboard/topnft-chart',[
    'uses' => 'ChartController@topnftChart',
]);

Route::get('/dashboard/trade-chart',[
    'uses' => 'ChartController@tradeChart',
]);


Route::get('/token',function(Request $request)
{
    $user = $request->header('Authorization');

   return response()->json(["token"=> $user]);
});




Route::get('characters-all','CharacterController@charTrans');

Route::get('homedashboard','HomeDashboardController@index');
Route::get('homebalance','HomeDashboardController@balance');
Route::post('homebalanceadd','HomeDashboardController@add')->middleware('auth:sanctum','verified');
Route::get('trade-all','CryptoTransactionController@trade');

//Route::get('searchcus','SearchController@searchcrypto');


Route::post('trade/crypto/{id}','CryptoTransactionController@tradecrypto')->middleware('auth:sanctum','verified');

Route::post('registercus','LoginController@register');
Route::post('search','SearchController@searchcrypto')->middleware('auth:sanctum','verified');

Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify'); // Make sure to keep this as your route name

Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
