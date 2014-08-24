<?php

/**
 * Handling User Operations
 * 
 * The UserController handles the login / logout / pasword reset / user details of a specific user
 * 
 * @author Werner Maisl
 * @copyright (c) 2014, Werner Maisl
 */
class UserController extends BaseController
{

    /**
     * Displays the login page and the password reset button
     */
    public function show_login($data_in = array())
    {
        $login = $this->check_login();

        if ($login != false)
        {
            return Redirect::to('/user/dashboard');
        }
        else
        {
            $data = array(
                "page_name" => "SDv2 | Login",
            );
            $data = array_merge($data, $data_in);

            $template = Config::get('sdv2.system_usertemplate');
            return View::make($template . ".login.login", $data);
        }
    }

    /**
     * 
     */
    public function show_require_login()
    {
        $this->show_login(array("message" => "You have to login / register to continue"));
    }
    
    /**
     * Displays the register page and the password reset button
     */
    public function show_register($data_in = array())
    {
        $login = $this->check_login();

        if ($login != false)
        {
            return Redirect::to('/user/dashboard');
        }
        else
        {
            $data = array(
                "page_name" => "SDv2 | Registration",
            );
            $data = array_merge($data, $data_in);

            $template = Config::get('sdv2.system_usertemplate');
            return View::make($template . ".login.register", $data);
        }
    }

    /**
     * Displays the password reset page
     */
    public function show_password_reset()
    {
        $login = $this->check_login();

        if ($login != false)
        {
            return Redirect::to('/user/dashboard');
        }
        else
        {
            $data = array(
                "page_name" => "SDv2 | Password Reset",
            );
            $data = array_merge($data, $data_in);

            $template = Config::get('sdv2.system_usertemplate');
            return View::make($template . ".login.reset_passwort", $data);
        }
    }

    /**
     * Displays the user profile
     * 
     * Shows the user the info that is stored in the db about him (groups he is assigned to, details in the user_info table, ...)
     */
    public function show_profile($data_in = array())
    {
        $user = $this->check_login();

        if ($user != false)
        {
            $data = array();

            //Check if User has setup his profile
            $user_infos = SDUserinfo::where('user_id', $user->id)->get();
            
            foreach($user_infos as $user_info)
            {
                $data[$user_info->type] = $user_info->value;
            }
            

            $data = array_merge($data, $data_in);
            $template = Config::get('sdv2.system_usertemplate');
            return View::make($template . ".dashboard.userprofile", $data);
        }
        else
        {
            return Redirect::to('/user/login');
        }
    }

    /**
     * Shows the Dashboard
     */
    public function show_dashboard()
    {
        $login = $this->check_login();

        if ($login != false)
        {
            $template = Config::get('sdv2.system_usertemplate');
            return View::make($template . ".dashboard.index");
        }
        else
        {
            return Redirect::to('/user/login');
        }
    }

    /**
     * Handles the post of the show_login() page
     */
    public function do_login()
    {
        try
        {
            $remember_me = false;
            if (Input::get('remember_me') == "on")
                $remember_me = true;

            // Login credentials
            $credentials = array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),
            );

            // Authenticate the user
            $user = Sentinel::authenticate($credentials, false);
            //print_r($user);
        }
        catch (Exception $e)
        {
            $data["message"] = "There has been a problem with your login: " . $e->getMessage();
            return $this->show_login($data);
            exit(0);
        }

        if (!isset($user) | $user == "")
        {
            $data["message"] = "There has been a problem with your login";
            return $this->show_login($data);
            exit(0);
        }

        //Check if User has setup his profile
        $setup = SDUserinfo::where('user_id', $user->id)->where('type', 'setup')->first();

        if ($setup != NULL)
        {
            return Redirect::to('/user/dashboard');
        }
        else
        {
            return Redirect::to('/user/profile');
        }
    }

    /**
     * Handles the post of the show_register() page
     */
    public function do_register()
    {
        $data = array();

        //Check if the passwords match
        if (Input::get('password') != Input::get('password2'))
        {
            $data["message"] = "PWs dont match";
            return $this->show_register($data);
            exit(0);
        }

        //Check if E-Mail is valid
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", Input::get('email')))
        {
            $data["message"] = "Invalid E-Mail";
            return $this->show_register($data);
            exit(0);
        }

        //Try to register the user
        try
        {
            // Create the user
            Sentinel::registerAndActivate(array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            ));

            // Find the group using the group id
            //$adminGroup = Sentry::findGroupById(1);
            // Assign the group to the user
            //$user->addGroup($adminGroup);
            $data["message"] = "Registration Successful -> Please log in below";
            return $this->show_login($data);
            exit(0);
        }
        catch (Exception $e)
        {
            $data["message"] = "There has been a problem: " . $e->getMessage();
            return $this->show_register($data);
            exit(0);
        }
    }

    /**
     * Handles the post of the show_password_reset() page
     */
    public function do_password_reset()
    {
        
    }

    /**
     * Handles the post of the change_profile()page
     */
    public function do_change_profile()
    {
        $user = $this->check_login();

        if ($user != false)
        {
            //Get the posted values and write them into the database
            $username = new SDUserinfo();
            $username->type = "username";
            $username->value = Input::get('username');
            $username->save();

            $steam_id = new SDUserinfo();
            $steam_id->type = "steamid";
            $steam_id->value = Input::get('steamid');
            $steam_id->save();
            
            //Check if the userprofile is setup;
            $setup = SDUserinfo::where('user_id', $user->id)->where('type', 'setup')->first();
            if ($setup == NULL)
            {
                $is_setup = new SDUserinfo();
                $is_setup->type = "setup";
                $is_setup->value = "true";
            }
            return Redirect::to('/user/profile');
        }
        else
        {
            return Redirect::to('/user/login');
        }
    }

    /**
     * Logs the user out
     */
    public function do_logout()
    {
        Sentinel::logout(null, true);
        return Redirect::to('/user/login');
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
