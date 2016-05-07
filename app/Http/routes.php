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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('inquiries', 'InquiryController');
});

Route::post( '/inquiries/update_ajax', array(
    'as' => 'inquiries.update_ajax',
    'uses' => 'InquiryController@update_ajax'
) );

//Route::resource('inquiries', ["uses" => 'InquiryController@index', 'middleware' => 'auth']); //Not working