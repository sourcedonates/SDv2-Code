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
        'items.show_bought' => true,
        'items.show_available' => true,
        'items.show_ip' => true,
        'items.create_item' => true,
        'items.create_ip' => true,
        'items.edit_item' => true,
        'items.edit_ip' => true,
        'items.assign_item' => true,
        'payment.show_pp' => true,
        'payment.show_transactions' => true,
        'payment.edit_pp' => true,
        'payment.create_pp' => true,
        'payment.create_transaction' => true,
        'payment.delete_pp' => true,
        'user.show_profile' => true,
        'users.show_users' => true,
        'users.edit_user' => true,
        'users.edit_useritems' => true,
        'usesr.delete_useritems' => true,
        'users.delete_user' => true,
        'users.create_user' => true,
        'users.create_useritems' => true,
        'stats.show_itemstats' => true,
        'stats.show_paymentstats' => true,
        'stats.show_userstats' => true,
        'stats.show_failedjobs' => true,
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

#Login
Route::get('/user/login',['before' => 'guest','uses' => 'UserController@show_login']);
Route::post('/user/login',['before' => 'guest','uses' => 'UserController@do_login']);
Route::get('/user/require_login',['before' => 'guest','uses' => 'UserController@show_require_login']);

#Logout
Route::any('/user/logout', 'UserController@do_logout');

#Register
Route::get('/user/register',['before' => 'guest','uses' => 'UserController@show_register']);
Route::post('/user/register',['before' => 'guest','uses' => 'UserController@do_register']);

#Forgot Password
Route::get('/user/forgot_password', 'UserController@show_password_reset');
Route::post('/user/forgot_password', 'UserController@do_password_reset');

#Dashboard
Route::get('/user/dashboard',['before' => 'auth','uses' => 'UserController@show_dashboard']);

#Profile
Route::get('/user/profile',['before' => 'auth','uses' => 'UserController@show_profile']);
Route::post('/user/profile',['before' => 'auth','uses' => 'UserController@do_change_profile']);

#Upload image
Route::post('/user/upload_image',['before' => 'auth','uses' => 'UserController@do_upload_image']);

#
#Users Routes
#
#Show SD Users
Route::get('/users/show_users',['before' => 'access:users.show_users','uses' => 'UsersController@show_users']);

#Create SD User
Route::get('/users/create_user',['before' => 'access:users.create_user','uses' => 'UsersController@show_create_user']);
Route::post('/users/create_user',['before' => 'access:users.create_user','uses' => 'UsersController@do_create_user']);

#Edit SD User
Route::get('/users/edit_user/{uid}',['before' => 'access:users.edit_user','uses' => 'UsersController@show_edit_user']);
Route::post('/users/edit_user/{uid}',['before' => 'access:users.edit_user','uses' => 'UsersController@do_edit_user']);

#Delete SD User
Route::get('/users/delete_user/{uid}',['before' => 'access:users.delete_user','uses' => 'UsersController@show_delete_user']);
Route::post('/users/delete_user/{uid}',['before' => 'access:users.delete_user','uses' => 'UsersController@do_delete_user']);


#
# Items Pages
#
#Show bought items
Route::get('/items/bought',['before' => 'access:items.show_bought','uses' => 'ItemsController@show_bought']);

#Show available items
Route::get('/items/available',['before' => 'access:items.show_available','uses' => 'ItemsController@show_available']);

#Show create items page
Route::get('/items/create',['before' => 'access:items.create_item','uses' => 'ItemsController@show_create']);
Route::post('/items/create',['before' => 'access:items.create_item','uses' => 'ItemsController@do_create']);

#Show assign items page
Route::get('/items/assign',['before' => 'access:items.assign_item','uses' => 'ItemsController@show_assign']);

#Show show_provider page
Route::get('/items/show_provider',['before' => 'access:show_ip','uses' => 'ItemsController@show_providers']);

#Show create provider page
Route::get('/items/create_provider',['before' => 'access:payment.create_ip','uses' => 'ItemsController@show_create_provider']);
Route::post('/items/create_provider',['before' => 'access:payment.create_ip','uses' => 'ItemsController@do_create_provider']);


#
# Payment Pages
#
# Show available payment provider
Route::get('/payment/show_provider',['before' => 'access:payment.show_pp','uses' => 'PaymentController@show_providers']);

# Create new payment provider
Route::get('/payment/create_provider',['before' => 'access:payment.create_pp','uses' => 'PaymentController@show_create_provider']);
Route::post('/payment/create_provider',['before' => 'access:payment.create_pp','uses' => 'PaymentController@do_create_provider']);

# Edit a existing payment provider
Route::get('/payment/edit_provider/{ppid}',['before' => 'access:payment.edit_pp','uses' => 'PaymentController@show_edit_provider']);
Route::post('/payment/edit_provider/{ppid}',['before' => 'access:payment.edit_pp','uses' => 'PaymentController@do_edit_provider']);

# Delete a existing payment provider
Route::get('/payment/delete_provider/{ppid}',['before' => 'access:payment.delete_pp','uses' => 'PaymentController@show_delete_provider']);
Route::post('/payment/delete_provider/{ppid}',['before' => 'access:payment.delete_pp','uses' => 'PaymentController@do_delete_provider']);

# Show payment transactions
Route::get('/payment/show_transactions',['before' => 'access:payment.show_transactions','uses' => 'PaymentController@show_transactions']);

# Add manual transaction
Route::get('/payment/create_transaction',['before' => 'access:payment.create_transaction','uses' => 'PaymentController@show_create_transaction']);
Route::post('/payment/create_transaction',['before' => 'access:payment.create_transaction','uses' => 'PaymentController@do_create_transaction']);


#
# Stats / Info Pages
#
# Show item stats
Route::get('/stats/item',['before' => 'access:stats.show_itemstats','uses' => 'StatsController@show_itemstats']);

# Show payment stats
Route::get('/stats/payment',['before' => 'access:stats.show_paymentstats','uses' => 'StatsController@show_paymentstats']);

# Show user stats
Route::get('/stats/user',['before' => 'access:stats.show_paymentstats','uses' => 'StatsController@show_userstats']);