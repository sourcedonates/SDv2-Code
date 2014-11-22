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

//Test Routes
Route::get('/perm/promote', function()
{
    Log::info("Promote Route has been called");

    $user = Sentinel::findById(1);
    echo "<p>user-id:" . $user->id . "</p>";
    echo "<p>user-mail:" . $user->email . "</p>";

    $user->permissions = [
        'items.show_bought' => 'true',
        'items.show_available' => 'true',
        'items.show_ip' => 'true',
        'items.create_item' => 'true',
        'items.create_ip' => 'true',
        'items.edit_item' => 'true',
        'items.edit_ip' => 'true',
        'items.assign_item' => 'true',
        'payment.show_pp' => 'true',
        'payment.show_transactions' => 'true',
        'payment.edit_pp' => 'true',
        'payment.create_pp' => 'true',
        'payment.create_transaction' => 'true',
        'user.show_profile' => 'true',
        'user.show_users' => 'true',
        'user.edit_users' => 'true',
        'user.edit_useritems' => 'true',
        'user.delete_useritems' => 'true',
        'user.delete_user' => 'true',
        'user.create_user' => 'true',
        'user.create_useritems' => 'true',
        'stats.show_itemstats' => 'true',
        'stats.show_paymentstats' => 'true',
        'stats.show_userstats' => 'true',
        'stats.show_failedjobs' => 'true',
    ];
    $user->save();
    echo "done";
});


//Default Route
Route::get('/', 'PresentationController@getIndex');


// Handle the Push Queue
Route::post('/queue/handle', function()
{
    return Queue::marshal();
});

Route::get('/queue/test', function()
{
    Queue::push('PaymentQueueWorker', array("transaction" => "1408202900"));
    return "Pushed to Queue";
});

Route::get('/queue/test2', function()
{
    Queue::push(function($job)
    {
        Log::info('Do something');
        $job->delete();
    });
    return "Pushed to Queue";
});

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


#
# User Pages
#
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

#Upload image
Route::post('/user/upload_image', 'UserController@do_upload_image');

#
# Items Pages
#
#Show bought items
Route::get('/items/bought', 'ItemsController@show_bought');

#Show available items
Route::get('/items/available', 'ItemsController@show_available');

#Show create items page
Route::get('/items/create', 'ItemsController@show_create');

#Show assign items page
Route::get('/items/assign', 'ItemsController@show_assign');

#Show show_provider page
Route::get('/items/show_provider', 'ItemsController@show_providers');

#Show create provider page
Route::get('/items/create_bought', 'ItemsController@show_create_provider');


#
# Payment Pages
#
# Show available payment provider
Route::get('/payment/show_provider', 'PaymentController@show_providers');

# Create new payment provider
Route::get('/payment/create_provider', 'PaymentController@show_create_provider');

# Show payment transactions
Route::get('/payment/show_transaction', 'PaymentController@show_transactions');

# Add manual transaction
Route::get('/payment/add_transaction', 'PaymentController@add_transaction');


#
# Stats / Info Pages
#
# Show item stats
Route::get('/stats/item', 'StatsController@show_itemstats');

# Show payment stats
Route::get('/stats/payment', 'StatsController@show_paymentstats');

# Show user stats
Route::get('/stats/user', 'StatsController@show_userstats');
