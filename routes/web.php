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
  Route::get('/criteria', 'DashboardController@criteria');
  Route::get('/grade', 'DashboardController@grade');
  Route::get('/ranking', 'DashboardController@ranking');

  // Teacher json
  Route::get('/teacher/table', 'TeacherController@table')->name('teacher');
  Route::resource('/teacher/json', 'TeacherController');

  // Criteria json
  Route::get('/criteria/table', 'CriteriaController@table')->name('criteria');
  Route::resource('/criteria/json', 'CriteriaController');

  // Grade json
  Route::get('/grade/table', 'GradeController@table')->name('grade');
  Route::resource('grade/json', 'GradeController');
});
