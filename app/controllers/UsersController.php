<?php

/**
 * SDv2 Users Controller
 * 
 * The UserController handles the creation and overview of all SDv2 users
 * 
 * This file is Part of SousrceDonatesv2
 * SousrceDonatesv2 is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. 
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @package    SousrceDonatesv2
 * @author     Werner Maisl
 * @copyright  (c) 2013-2014 - Werner Maisl
 * @license    GNU AGPLv3 http://www.gnu.org/licenses/agpl-3.0.txt
 */
class UsersController extends BaseController
{

    /**
     * Show Users
     * 
     * Shows the currently registered Users
     */
    public function show_users()
    {
        $has_access = $this->check_access(['user.show_users']);

        if ($has_access['access'] == true)
        {
            //Load the User Infos
            $user = $has_access['user'];
            $data['user'] = $user;
            $user_infos = SDUserinfo::where('user_id', $user->id)->get();
            foreach ($user_infos as $user_info)
            {
                $data[$user_info->type] = $user_info->value;
            }

            //Load the User Data
            $data["users"] = DB::table('users')->get();

            // Return the page
            $template = Config::get('sdv2.system_backendtemplate');
            return View::make($template . ".users.show_users", $data);
        }
        else
        {
            if ($has_access['redirect'] != false)
            {
                return $has_access['redirect'];
            }
            else
            {
                return Redirect::to('/user/dashboard')->with('error', 'There has been an SD Error: Code 501');
            }
        }
    }

    /**
     * Show Create User
     * 
     * Shows the Create User Page
     */
    public function show_create_user()
    {
        
    }

    /**
     * Show Edit User
     * 
     * Shows the Edit User Page
     */
    public function show_edit_user()
    {
        
    }

    /**
     * Show Delete User
     * 
     * Shows the Delete User Page
     */
    public function show_delete_user()
    {
        
    }

    /**
     * Access Check
     * 
     * Checks if the User has the required access
     */
    private function check_access($access)
    {
        $has_access = array();
        if ($user = Sentinel::check())
        {
            if ($user->hasAccess($access))
            {
                $has_access['access'] = true;
                $has_access['redirect'] = false;
                $has_access['user'] = $user;
                return $has_access;
            }
            else
            {
                $has_access['access'] = false;
                $has_access['redirect'] = Redirect::to('/user/dashboard')->with('error', 'You do not have the required permissions to access the selected page');
                $has_access['user'] = $user;
                return $has_access;
            }
        }
        else
        {

            $has_access['access'] = false;
            $has_access['redirect'] = Redirect::to('/user/login');
            $has_access['user'] = false;
            return $has_access;
        }
    }

}
