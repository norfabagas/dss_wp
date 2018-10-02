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

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
  if (auth()->check()) {
    return redirect('dashboard');
  } else {
    return redirect('login');
  }
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
  // Dashboard
  Route::get('/', 'DashboardController@index');
  Route::get('/teacher', 'DashboardController@teacher');

  // Teacher json
  Route::get('/teacher/table', 'TeacherController@table')->name('teacher');
  Route::resource('/teacher/json', 'TeacherController');
});
