<?php

/**
 * Showing the Dashbaord
 * 
 * The Dashboard Controller shows the Dashboard to logged in users
 * 
 * @author Werner Maisl
 * @copyright (c) 2014, Werner Maisl
 */
class DashboardController extends BaseController
{

    /**
     * Show the main page
     */
    public function show_index()
    {
        $login = $this->check_login();

        if ($login != false)
        {
            $template = Config::get('sdv2.system_usertemplate');
            return View::make($template . ".dashboard.index");
        }
        else
        {
            Redirect::to('/user/login');
        }
    }

    /**
     * Login Check
     * 
     * Checks if a User is logged in and redirects him to the login page if he is not
     */
    private function check_login()
    {
        if ($user = Sentinel::check())
        {
            return $user;
        }
        else
        {
            return false;
        }
    }

}
