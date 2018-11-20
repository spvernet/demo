<?php

namespace App\Tests\Test\Web;


use App\Domain\Core\AbstractOutput;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserExistUseCaseTest extends WebTestCase
{

    public function testUserExistOKAction(){

        $client = $this->createClient();
        $client->request('GET', '/user/test1');
        $data= json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(AbstractOutput::CODE_OK, $client->getResponse()->getStatusCode());
        $this->assertEquals(true, $data['data']['is_valid']);
    }

    public function testUserExistKOAction(){

        $client = $this->createClient();
        $client->request('GET', '/user/test10');
        $data= json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(AbstractOutput::CODE_NOT_FOUND, $client->getResponse()->getStatusCode());
        $this->assertEquals([], $data['data']);
        $this->assertArrayHasKey('message', $data['metadata'][0]);
    }
}