<?php

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

Route::get('task/complete/{id}', 'TasksController@update_complete');

Route::resource('task', 'TasksController');

Route::get('/', function () {
    return redirect()->route('task.index');
});
