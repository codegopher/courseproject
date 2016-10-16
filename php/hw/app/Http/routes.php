<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Rewrite this in RouteController

Route::Get('/', 'RouteController@RootRequest');

Route::Get('/main', 'RouteController@MainRequest');
//Route::Get('/main', function() {return view('main');});

Route::Get('/about', function() {return view('about');});

Route::Get('/contact', function() {return view('contact');});

Route::Get('/case', 'RouteController@CaseRequest');
//Route::Get('/case', function() {return view('case');});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/home/avaliable', 'HomeController@avaliable');

Route::resource('task','TaskController', ['except' => ['update'] ] );
Route::Post('task/{id}','TaskController@update');

Route::Get('/success', function() {return view('success');});
