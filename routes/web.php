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

Route::get('/','App\Http\Controllers\BlogsController@index');

// Auth
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// App
Route::get('/blogs', 'App\Http\Controllers\BlogsController@index')->name('blogs');
Route::get('/blogs/create', 'App\Http\Controllers\BlogsController@create')->name('blogs.create');
Route::post('/blogs/store', 'App\Http\Controllers\BlogsController@store')->name('blogs.store');
Route::get('/blogs/unreleased', 'App\Http\Controllers\BlogsController@unreleased')->name('blogs.unreleased');

//Trashed Blogs
Route::get('/blogs/trash', 'App\Http\Controllers\BlogsController@trash')->name('blogs.trash');
Route::get('/blogs/trash/{id}/restore', 'App\Http\Controllers\BlogsController@restore')->name('blogs.restore');
Route::get('/blogs/trash/{id}/permDelete', 'App\Http\Controllers\BlogsController@permDelete')->name('blogs.permDelete');
Route::get('/blogs/trash/{id}/deleteDraft', 'App\Http\Controllers\BlogsController@deleteDraft')->name('blogs.deleteDraft');


Route::get('/blogs/{id}', 'App\Http\Controllers\BlogsController@show')->name('blogs.show');

Route::get('/blogs/{id}/edit', 'App\Http\Controllers\BlogsController@edit')->name('blogs.edit');
Route::patch('/blogs/{id}/update', 'App\Http\Controllers\BlogsController@update')->name('blogs.update');
Route::post('/blogs/{id}/release', 'App\Http\Controllers\BlogsController@release')->name('blogs.release');
Route::post('/blogs/{id}/unrelease', 'App\Http\Controllers\BlogsController@unrelease')->name('blogs.unrelease');
Route::post('/blogs/{id}/delete', 'App\Http\Controllers\BlogsController@delete')->name('blogs.delete');


//Admin Routes
Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin.index');

Route::get('/admin/users', 'App\Http\Controllers\UserController@index')->name('admin.users');
Route::get('/admin/{id}/promote', 'App\Http\Controllers\AdminController@promote')->name('admin.promote');
Route::get('/admin/{id}/demote', 'App\Http\Controllers\AdminController@demote')->name('admin.demote');

//category routes
Route::resource('categories', 'App\Http\Controllers\CategoryController');
Route::resource('users', 'App\Http\Controllers\UserController');


// File manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
