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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomesController@index');
Route::get('/courses', 'CoursesController@index');
Route::post('/courses', 'CoursesController@store');
Route::delete('/courses/{course}', 'CoursesController@destroy');
Route::patch('/courses/{course}', 'CoursesController@update');
Route::get('/majors', 'MajorsController@index');
Route::post('/majors', 'MajorsController@store');
Route::delete('/majors/{major}', 'MajorsController@destroy');
Route::patch('/majors/{major}', 'MajorsController@update');
Route::get('/students', 'StudentsController@index');
Route::post('/students', 'StudentsController@store');
Route::get('/students/{student}', 'StudentsController@show');
Route::delete('/students/{student}', 'StudentsController@destroy');
Route::patch('/students/{student}', 'StudentsController@update');
