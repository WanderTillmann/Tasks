<?php

use App\Http\Middleware\CheckTasks;

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

Route::group(['middleware' => ['auth']], function() {

    Route::view('/','welcome');
    
    Route::get('clients/photo/{client}','ExtraActions\ClientPhotoDownload')->name('clients.photo_download');
    Route::get('clients/pdf', 'ExtraActions\ClientPdf');
    Route::resource('clients', 'ClientController');

    Route::resource('projects', 'ProjectController');
    Route::resource('tasks', 'TaskController');
    Route::post('tasks/search','ExtraActions\TaskSearch');

    Route::get('clients','ClientController@index')->name('clients.index');
    Route::get('clients/{id}','ClientController@show')->name('clients.show');
    
    Route::get('tasks/todo/made/{id}','TodoTasksController@made')->name('tasks.todo_made');
    Route::get('tasks/todo/list', 'ToDoTasksController@index')->name('tasks.todo_index');
    Route::get('tasks/add/{id}', 'ToDoTasksController@store')->name('tasks.add');
    Route::get('tasks/delete/{id}', 'ToDoTasksController@destroy')->middleware(CheckTasks::class)->name('tasks.todo_destroy');

    
    Route::post('task/project/attach/{task}','TaskProjectController@attach')->name('tasks.project_attach');
    Route::get('task/project/detach/{task}/{project_id}','TaskProjectController@detach')->name('tasks.project_detach');
    
});

Auth::routes();