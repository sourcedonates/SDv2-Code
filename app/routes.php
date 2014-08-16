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

Route::get('/', 'ItemsController@getIndex');


// Handle the Push Queue
Route::post('/queue/handle', function()
{
    return Queue::marshal();
});


Route::get('/queue/test', function()
{
    \Queue::push('PaymentQueueWorker',array("transaction"=>"1408151301"));
    return "Pushed to Queue";
});


class PaymentQueueWorker
{
    public function fire($job, $data)
    {
        File::append(app_path().'/test.txt',$data['transaction']."-".time());
    }
}


#
# Payment Routes
#

Route::any('/payment/process', 'PaymentController@process_payment'); //Route for accepting the posted form
# Success / Cancel Return URL
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
    if ($user = Sentinel::check())
    {
        return Redirect::to('user/dashboard');
    }
    else
    {
        return Redirect::to('user/login');
    }
});

#Login
Route::get('/user/login', 'UserController@show_login');
Route::post('/user/login', 'UserController@do_login');
Route::get('/user/require_login', 'UserController@show_require_login');

#Logout
Route::any('/user/logout', 'UserController@do_logout');

#Register
Route::get('/user/register', 'UserController@show_register');
Route::post('/user/register', 'UserController@do_register');

#Forgot Password
Route::get('/user/forgot_password', 'UserController@show_password_reset');
Route::post('/user/forgot_password', 'UserController@do_password_reset');

#Dashboard
Route::get('/user/dashboard', 'UserController@show_dashboard');

#Profile
Route::get('/user/profile', 'UserController@show_profile');
Route::post('/user/profile', 'UserController@do_change_profile');
