<?php

namespace App\Tests\Test\Web;


use App\Domain\Core\AbstractOutput;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserValidationUseCaseTest extends WebTestCase
{

    public function testUserValidationOKAction(){

        $data = array(
                'username' => 'test1',
                'password' => '123456789'
            );

        $client = $this->createClient();

        $client->request(
            'POST',
            '/user',
            array(
                'Content-type' => 'application/json; charset=utf-8',
            ),
            array(),
            array(),
            json_encode($data)
        );

        $result= json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(AbstractOutput::CODE_OK, $client->getResponse()->getStatusCode());
        $this->assertEquals([], $result['metadata']);
        $this->assertArrayHasKey('id', $result['data']);
        $this->assertArrayHasKey('name', $result['data']);
        $this->assertArrayHasKey('surname', $result['data']);

    }

    public function testUserValidationKOAction(){

        $data = array(
            'username' => 'test10',
            'password' => '123456789'
        );

        $client = $this->createClient();

        $client->request(
            'POST',
            '/user',
            array(
                'Content-type' => 'application/json; charset=utf-8',
            ),
            array(),
            array(),
            json_encode($data)
        );

        $result= json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(AbstractOutput::CODE_NOT_FOUND, $client->getResponse()->getStatusCode());
        $this->assertEquals([], $result['data']);
        $this->assertArrayHasKey('message', $result['metadata'][0]);
    }


}