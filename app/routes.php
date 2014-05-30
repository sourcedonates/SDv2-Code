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

//Route::any('/ipn/{provider}', 'PaymentController@process_ipn'); //Route for processing the IPN

Route::controller('/', 'ItemsController');

