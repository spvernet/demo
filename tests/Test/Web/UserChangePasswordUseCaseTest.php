<?php

namespace App\Tests\Test\Web;


use App\Domain\Core\AbstractOutput;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserChangePasswordUseCaseTest extends WebTestCase
{

    public function testUserChangePasswordOKAction(){
        $this->markTestSkipped("Ejercicio bonus");

        $data = array(
            'new_password' => '123456789'
        );

        $client = $this->createClient();

        $client->request(
            'PUT',
            '/user/password',
            array(
                'Content-type' => 'application/json; charset=utf-8',
            ),
            array(),
            array(),
            json_encode($data)
        );

        $result= json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(AbstractOutput::CODE_EMPTY, $client->getResponse()->getStatusCode());
        $this->assertEquals([], $result);
    }


    public function testUserChangePasswordKOAction(){
        $this->markTestSkipped("Ejercicio bonus");

        $data = array(
            'new_password' => '123456789'
        );

        $client = $this->createClient();

        $client->request(
            'PUT',
            '/user/password',
            array(
                'Content-type' => 'application/json; charset=utf-8',
            ),
            array(),
            array(),
            json_encode($data)
        );

        $result= json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(AbstractOutput::CODE_UNPROCESSABLE, $client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('message', $result['metadata'][0]);
    }
}