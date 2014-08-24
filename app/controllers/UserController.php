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

            $template = Config::get('sdv2.system_backendtemplate');
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

            $template = Config::get('sdv2.system_backendtemplate');
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

            $template = Config::get('sdv2.system_backendtemplate');
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

            //Get the user details from the db
            $user_infos = SDUserinfo::where('user_id', $user->id)->get();

            foreach ($user_infos as $user_info)
            {
                $data[$user_info->type] = $user_info->value;
            }

            //Check if the profile is setup
            if (isset($data['username']) && isset($data['steamid']))
            {
                $data['setup'] = true;
            }
            else
            {
                $data['setup'] = false;
            }

            $data = array_merge($data, $data_in);
            $data['user'] = $user;
            $template = Config::get('sdv2.system_backendtemplate');
            return View::make($template . ".user.profile", $data);
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
        $user = $this->check_login();

        if ($user != false)
        {
            $data['user'] = $user;
            $template = Config::get('sdv2.system_backendtemplate');
            return View::make($template . ".dashboard.index", $data);
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
            //Check if the username and the steamid already exists
            $check_username = SDUserinfo::where('type', 'username')->where('value', Input::get('username'))->first();
            if ($check_username != NULL)
            {
                //The username already exists
                if ($check_username->user_id != $user->id)
                {
                    //The username has been taken by someone else
                    $this->show_profile(array("error" => "Update Failed. Username is already taken by someone else"));
                    exit(0);
                }
            }
            //Check if the username and the steamid already exists
            $check_steamid = SDUserinfo::where('type', 'steamid')->where('value', Input::get('steamid'))->first();
            if ($check_steamid != NULL)
            {
                //The username already exists
                if ($check_steamid->user_id != $user->id)
                {
                    //The steamid has been taken by someone else
                    $this->show_profile(array("error" => "Update Failed. Steamid is already taken by someone else"));
                    exit(0);
                }
            }

            //Update the username has setup a username before
            $username = SDUserinfo::where('user_id', $user->id)->where('type', 'username')->first();
            if ($username == NULL)
            {
                $username = new SDUserinfo();
                $username->user_id = $user->id;
                $username->type = "username";
            }
            $username->value = Input::get('username');
            $username->save();

            //Update the steamid if the user has setup a steamid before
            $steam_id = SDUserinfo::where('user_id', $user->id)->where('type', 'steamid')->first();
            if ($steam_id == NULL)
            {
                $steam_id = new SDUserinfo();
                $steam_id->user_id = $user->id;
                $steam_id->type = "steamid";
            }
            $steam_id->value = Input::get('steamid');
            $steam_id->save();

            $this->show_profile(array("message" => "Update Successful"));
        }
        else
        {
            return Redirect::to('/user/login');
        }
    }

    /**
     * Handles the image upload
     */
    public function do_upload_image()
    {
        $user = $this->check_login();

        if ($user != false)
        {
            dd(Input::File('userimage'));
            if (Input::hasFile('userimage'))
            {
                $file = Input::file('userimage');

                if ($file->getClientOriginalExtension() == "png")
                {
                    $file->move(public_path() . '/uploads/userimages/', $user->id . "-avatar.png");
                }
                else
                {
                    $this->show_profile(array("error" => "Wrong file extension"));
                }
            }
            else
            {
                $this->show_profile(array("error" => "Uploaded file not found"));
            }
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
