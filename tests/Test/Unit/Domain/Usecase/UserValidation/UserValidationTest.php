<?php

namespace App\Tests\Test\Unit\Domain\Usecase\UserValidation;


use App\Domain\Core\AbstractOutput;
use App\Domain\Usecase\UserValidation\UserValidationRequest;
use App\Domain\Usecase\UserValidation\UserValidationUseCase;
use App\Infrastructure\Output\UserValidationOutput;
use App\Infrastructure\Repository\inMemory\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Log\Logger;

class UserValidationTest extends TestCase
{
    public function testIsValidOK(){
        $request = new UserValidationRequest('a','b');
        $this->assertEquals(true, $request->isValid());

    }

    public function testIsValidKO(){
        $request = new UserValidationRequest('a','');
        $this->assertEquals(false, $request->isValid());
    }

    public function testUserNotFound()
    {
        $repository = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(['getUserInfo'])
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('getUserInfo')
            ->willReturn(null)
        ;

        $request = new UserValidationRequest('a','b');
        $userValidation = new UserValidationUseCase(
            $request,
            $repository,
            new UserValidationOutput(),
            new Logger()
        );

        /** @var JsonResponse $result */
        $result = $userValidation->execute();
        $response = json_decode($result->getContent(), true);

        $this->assertEquals([],$response['data']);
        $this->assertEquals(AbstractOutput::CODE_NOT_FOUND, $response['metadata'][0]['code']);
    }

    public function testUserFound()
    {

        $user = [   'id'=>2,
            'username'=> 'test2',
            'password'=>password_hash('987654321', PASSWORD_DEFAULT),
            'name' => 'Pol',
            'surname'=> 'Garcia'
        ];

        $repository = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(['getUserInfo'])
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('getUserInfo')
            ->willReturn($user)
        ;

        $request = new UserValidationRequest('a','b');
        $userValidation = new UserValidationUseCase(
            $request,
            $repository,
            new UserValidationOutput(),
            new Logger()
        );

        /** @var JsonResponse $result */
        $result = $userValidation->execute();
        $response = json_decode($result->getContent(), true);

        $this->assertEquals([],$response['metadata']);
        $this->assertEquals( 2, $response['data']['id']);
        $this->assertEquals( 'Pol', $response['data']['name']);
        $this->assertEquals( 'Garcia', $response['data']['surname']);
    }

}