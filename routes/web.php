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
	return view('auth.login');
});

Auth::routes(['verify' => true]);

$groupData = [
	'namespace' => 'UPC\User',
	'prefix' => 'user/upc',
];

Route::group($groupData, function () {
	//UPCCalculator
	$methods = ['index', 'create', 'store', 'destroy'];
	Route::resource('calculation', 'UPCController')
		->only($methods)
		->names('upc.user.calculation');
	//Tariffs
	$methods = ['index', 'edit', 'update', 'create', 'store', 'destroy'];
	Route::resource('tariffs', 'TariffsController')
		->only($methods)
		->names('upc.user.tariffs');
});

Route::delete('/user/destroy/{user}', 'UPC\User\UserController@destroy')->name('user.destroy');

Route::get('/user/chart/index', 'UPC\User\ChartController@index')->name('user.chart.index');
Route::get('/user/chart/total', 'UPC\User\ChartController@getDataChartTotal')->name('user.chart.get.total');
Route::get('/user/chart/gaz', 'UPC\User\ChartController@getDataChartGaz')->name('user.chart.get.gaz');
Route::get('/user/chart/water', 'UPC\User\ChartController@getDataChartWater')->name('user.chart.get.water');
Route::get('/user/chart/heat', 'UPC\User\ChartController@getDataChartHeat')->name('user.chart.get.heat');
Route::get('/user/chart/elect', 'UPC\User\ChartController@getDataChartElect')->name('user.chart.get.elect');







