<?php

class ExampleTest extends TestCase
{

    /**
     * Tests if the user Login page is OK
     *
     * @return void
     */
    public function testUserLoginContainsEmailField()
    {
        $UserController = new UserController;
        $login_form = $UserController->show_login();
        
        $contains_email_field = false;
        
        if(strpos($login_form, '<input type="text" name="email" class="form-control" placeholder="E-Mail"/>')!== false)
                $contains_email_field == true;
        $this->assertTrue($contains_email_field);
    }

    
    /**
     * Tests if the user Login page is OK
     *
     * @return void
     */
    public function testUserRegisterOk()
    {
        //$crawler = $this->client->request('GET', '/user/register');

        //$this->assertTrue($this->client->getResponse()->isOk());
    }
}
