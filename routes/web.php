<?php
use Illuminate\Http\Request;
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


// Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

// Route::get('character/get/{id}','characterController@index')->name('char.index');
    Route::get('characters/all','App\Http\Controllers\CharacterController@getChar')->name('char.index');
    Route::resource('characters', 'CharacterController');
    


    // Route::group(['middleware' => 'role:customer'], function() {
Route::get('customers/all','App\Http\Controllers\CustomerController@getCus');
Route::resource('customers', 'CustomerController');



Route::get('employees/all','App\Http\Controllers\EmployeeController@getEmp');
Route::resource('employees', 'EmployeeController');


Route::get('cryptos/all','App\Http\Controllers\CryptoController@getCry');
Route::resource('cryptoss', 'CryptoController');
// });


Route::view('/cryptocurrencies','cryptotransaction.index'); 
Route::get('main','App\Http\Controllers\LoginController@main');


// Route::get('logout','LoginController@logout');
 Route::get('login','LoginController@showLogin')->name('login');


Route::view('search1','search.searchcrypto');

Route::view('search2','search.searchnft');


Route::view('/trade','cryptotransaction.trade'); 
Route::view('/register','login.register'); 


Route::get('/action','SearchController@searchcrypto' )->name('action');


Route::get('/action1','SearchController@searchnft' )->name('action1');

// Route::post('/item/checkout',[
//     'uses' => 'ItemController@postCheckout',
//     'as' => 'checkout'
// ]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::view('verified','verified');
