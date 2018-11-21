<?php

namespace App\Tests\Test\Web;


use App\Domain\Core\AbstractOutput;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserExistUseCaseTest extends WebTestCase
{

    public function testUserExistOKAction(){

        $client = $this->createClient();
        $client->request('GET', '/user/test1');
        $result= json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(AbstractOutput::CODE_OK, $client->getResponse()->getStatusCode());
        $this->assertEquals(true, $result['data']['is_valid']);
    }

    public function testUserExistKOAction(){

        $client = $this->createClient();
        $client->request('GET', '/user/test10');
        $result= json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(AbstractOutput::CODE_NOT_FOUND, $client->getResponse()->getStatusCode());
        $this->assertEquals([], $result['data']);
        $this->assertArrayHasKey('message', $result['metadata'][0]);
    }
}