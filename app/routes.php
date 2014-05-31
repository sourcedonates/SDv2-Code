<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |


  Route::get('/payment', function()
  {
  return "Redirect::to('items')";
  });
 */
//Route::controller('/', 'ItemsController');
#
# Payment Routes
#

Route::any('/payment/process', 'PaymentController@process_payment'); //Route for accepting the posted form

Route::any('/payment/success', function()
{
    echo "<pre>";
    var_dump(Input::all());
    echo "</pre>";
    return "Success Page";
});

Route::any('/payment/cancel', function()
{
    echo "<pre>";
    var_dump(Input::all());
    echo "</pre>";
    return "Cancel Page";
});

#
# User Routes
#
Route::get('/user', function()
{
    return Redirect::to('user/login');
});

#Login
Route::get('/user/login', 'UserController@show_login');
Route::post('/user/login', 'UserController@do_login');

#Register
Route::get('/user/register', 'UserController@show_register');
Route::post('/user/register', 'UserController@do_register');

#Forgot Password
Route::get('/user/forgot_password', 'UserController@show_password_reset');
Route::post('/user/forgot_password', 'UserController@do_password_reset');