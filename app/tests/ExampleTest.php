<?php

class ExampleTest extends TestCase
{

    /**
     * Tests if the user Login page is OK
     *
     * @return void
     */
    public function testUserLoginOk()
    {
        $crawler = $this->client->request('GET', '/user/login');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    
    /**
     * Tests if the user Login page is OK
     *
     * @return void
     */
    public function testUserRegisterOk()
    {
        $crawler = $this->client->request('GET', '/user/register');

        $this->assertTrue($this->client->getResponse()->isOk());
    }
}
