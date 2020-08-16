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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/project', 'ProjectController@index')->name('project');


Route::post('/project', 'ProjectController@add');
Route::get('/project/{id}/tasks', 'ProjectController@view_tasks');
Route::get('/project/{id}/delete', 'ProjectController@delete');


Route::post('/project/{id}/task/add', 'TaskController@add');
Route::get('/project/{id}/task/edit/{task}', 'TaskController@show');
Route::post('/project/{id}/task/edit/{task}', 'TaskController@edit');
Route::post('/project/{id}/task/reorder', 'TaskController@update_tasks_by_priority');
Route::get('/project/{id}/task/{task}/delete', 'TaskController@delete');



