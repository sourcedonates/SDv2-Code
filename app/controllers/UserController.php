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
    public function show_login()
    {
        
    }
    
    /**
     * Displays the password reset page
     */
    public function show_password_reset()
    {
        
    }
    
    /**
     * Displays the user profile
     * 
     * Shows the user the info that is stored in the db about him (groups he is assigned to, details in the user_info table, ...)
     */
    public function show_profile()
    {
        
    }
    
    /**
     * Displays the change profile page
     * 
     * Allows the user to change his userinfos (the data stored in the user_info table)
     * 
     * @todo Add APs (Auth Provider) that make the changes for the user (For example redirect him to steam->openid to log him in)
     * 
     */
    public function change_profile()
    {
        
    }
    
    
    /**
     * Handles the post of the show_login() page
     */
    public function do_login()
    {
        
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
        
    }
    
    /**
     * Handles the post of the logout button
     */
    public function do_logout()
    {
        
    }
}