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
        //Load the User Infos
        $user = Sentinel::check();
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

    /**
     * Show Create User
     * 
     * Shows the Create User Page
     */
    public function show_create_user()
    {
        //Load the User Infos
        $user = Sentinel::check();
        $data['user'] = $user;
        $user_infos = SDUserinfo::where('user_id', $user->id)->get();
        foreach ($user_infos as $user_info)
        {
            $data[$user_info->type] = $user_info->value;
        }

        //Load the User Data
        // Return the page
        $template = Config::get('sdv2.system_backendtemplate');
        return View::make($template . ".users.show_create_user", $data);
    }

    /**
     * Show Edit User
     * 
     * Shows the Edit User Page
     */
    public function show_edit_user($uid)
    {
        //Load the User Infos
        $user = Sentinel::check();
        $data['user'] = $user;
        $user_infos = SDUserinfo::where('user_id', $user->id)->get();
        foreach ($user_infos as $user_info)
        {
            $data[$user_info->type] = $user_info->value;
        }

        //Load the User Data of the User being modded
        $mod_user = DB::table('users')->where('id', $uid)->first();
        $data["mod_user"] = $mod_user;
        $mod_user_infos = SDUserinfo::where('user_id', $uid)->get();
        $data["mod_user_infos"] = $mod_user_infos;


        // Return the page
        $template = Config::get('sdv2.system_backendtemplate');
        return View::make($template . ".users.show_edit_user", $data);
    }

    /**
     * Edits the User
     */
    public function do_edit_user($uid)
    {
        $part = Input::get('part');

        switch ($part)
        {
            case "user":
                $user_id = Input::get('id');
                $mod_user = Sentinel::findById($user_id);
                $credentials = [
                    'email' => Input::get('email'),
                ];
                Sentinel::update($mod_user,$credentials);
                return Redirect::to('/users/edit_user/'.$user_id);
                break;
            
            case "userinfos_edit":
                $user_id = Input::get('id');
                $user_info = SDUserinfo::find($user_id);
                
                $user_info->type = Input::get('type');
                $user_info->value = Input::get('value');
                $user_info->save();
                
                return Redirect::to('/users/edit_user/'.$user_id);
                break;
            
            case "userinfos_delete":
                $user_id = Input::get('id');
                $user_info = SDUserinfo::find($user_id);
                $user_info->delete();
                
                return Redirect::to('/users/edit_user/'.$user_id);
                break;
            
            case "userinfos_add":
                $user_id = Input::get('user_id');
                $user_info = new SDUserinfo;
                $user_info->user_id = $user_id;
                $user_info->type = Input::get('type');
                $user_info->value = Input::get('value');
                $user_info->save();
                
                echo "<p>".$user_id."</p>";
                echo "<p>".Input::get('type')."</p>";
                echo "<p>".Input::get('value')."</p>";
                //return Redirect::to('/users/edit_user/'.$user_id);
                break;
        }
    }

    /**
     * Show Delete User
     * 
     * Shows the Delete User Page
     */
    public function show_delete_user($uid)
    {
        
    }

}
