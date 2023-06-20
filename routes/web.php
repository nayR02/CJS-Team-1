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
Route::get('/candidates', function () {
    return view('candidates');
});
Route::get('/categories', function () {
    return view('/categories/index');
});
Route::get('/criterias', function () {
    return view('/criterias/criteria');
});
use App\Http\Controllers\configuration_controller;
use App\Http\Controllers\InputController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CriteriaController;

// Candidates Routes
Route::post('/candidates', [configuration_controller::class, 'save'])->name('candidates');
Route::get('/candidates', [configuration_controller::class, 'get_info'])->name('get_info');
Route::get('/delete_info/{id}', [configuration_controller::class, 'delete_info'])->name('delete_info');
// -- Judges Route
Route::post('/judges/create', [configuration_controller::class, 'generate'])->name('judge.generate');
Route::get('/judges', [configuration_controller::class, 'judgeRead'])->name('judge_info');
Route::get('/delete_judge/{id}', [configuration_controller::class, 'delete_judge'])->name('delete_judge');


// -- Events Route || Rounds
Route::post('/add_info', [InputController::class, 'storeInputs'])->name('event.input');
Route::get('/add_info', [InputController::class, 'read'])->name('read_add_info');
Route::get('/delete_event/{id}', [InputController::class, 'delete_event'])->name('delete_event');

// -- Login
Route::get('/admin-login', [InputController::class, 'adminLogin'])->name('admin-user');
Route::post('/admin-login', [InputController::class, 'save'])->name('user');
Route::get('logout', [InputController::class, 'adminLogout'])->name('admin-logout');

// -- Category
Route::post('/categories', [CategoryController::class, 'saveCategory'])->name('save.category');
Route::get('/categories/{rounds}', [CategoryController::class, 'getCategory'])->name('get.category');
Route::get('/categories/delete/{category_id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');
Route::put('/categories/{category_id}', [CategoryController::class, 'updateCategory'])->name('update.category');

// Route::put('/categories/{categoryId}', [CategoryController::class, 'updateCategory'])->name('update.category');

// Criteria
Route::post('/criterias', [CriteriaController::class, 'saveCriteria'])->name('save.criteria');

//-- Judge 
Route::get('judgelogout', 'App\Http\Controllers\judgeController@judgeLogout')->name('judge-logout');
Route::get('/judge-login', 'App\Http\Controllers\judgeController@judgeLogin')->name('judge-user');
Route::post('/judge-login', 'App\Http\Controllers\judgeController@judgeLog')->name('judge-Log');

Route::middleware(['denyJudgeAccess'])->group(function () {
    // Judge routes here
    Route::get('/judge-dashboard', 'App\Http\Controllers\judgeController@dashboard')->name('judgeDash');
});
