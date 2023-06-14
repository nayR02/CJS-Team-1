<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin-login');
});
Route::get('/judges', function () {
    return view('judges');
});
Route::get('/test', function () {
    return view('test');
});
Route::get('/candidates', function () {
    return view('candidates');
});
Route::get('/categories', function () {
    return view('categories');
});

// Candidates Routes
Route::post('/candidates', 'App\http\Controllers\configuration_controller@save')->name('candidates');
Route::get('/candidates', 'App\http\Controllers\configuration_controller@get_info')->name('get_info');
Route::get('/delete_info/{id}', 'App\http\Controllers\configuration_controller@delete_info')->name('delete_info');
// -- Judges Route
Route::post('/judges/create', 'App\http\Controllers\configuration_controller@generate')->name('judge.generate');
Route::get('/judges', 'App\http\Controllers\configuration_controller@judgeRead')->name('judge_info');
Route::get('/delete_judge/{id}', 'App\http\Controllers\configuration_controller@delete_judge')->name('delete_judge');
// -- Events Route
Route::post('/add_info', 'App\Http\Controllers\InputController@storeInputs')->name('event.input');
Route::get('/add_info', 'App\Http\Controllers\InputController@read')->name('read_add_info');
Route::get('/delete_event/{id}', 'App\Http\Controllers\InputController@delete_event')->name('delete_event');

// -- Login
Route::get('/admin-login', 'App\Http\Controllers\InputController@adminLogin')->name('admin-user');
Route::post('/admin-login', 'App\Http\Controllers\InputController@save')->name('user');
Route::get('logout', 'App\Http\Controllers\InputController@adminLogout')->name('admin-logout');