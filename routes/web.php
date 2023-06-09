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
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/add_info', function () {
    return view('add_info');
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

// Create Candidates
Route::post('/candidates', 'App\http\Controllers\configuration_controller@save')->name('candidates');
// Read Candididates
Route::get('/candidates', 'App\http\Controllers\configuration_controller@get_info')->name('get_info');
// Delete Candidates
Route::get('/delete_info/{id}', 'App\http\Controllers\configuration_controller@delete_info')->name('delete_info');
// -- Judges Create
// Route::get('/judges', 'App\http\Controllers\configuration_controller@showForm')->name('judge.form');

//  -- Judges Create
Route::post('/judges', 'App\http\Controllers\configuration_controller@generate')->name('judge.generate');
//  --Judges Read
Route::get('/judges', 'App\http\Controllers\configuration_controller@judgeRead')->name('judge_info');
// --Judges Delete 
Route::get('/delete_judge/{id}', 'App\http\Controllers\configuration_controller@delete_judge')->name('delete_judge');

// -- Store Dynamic data
Route::post('/add_info', 'App\http\Controllers\InputController@store');


