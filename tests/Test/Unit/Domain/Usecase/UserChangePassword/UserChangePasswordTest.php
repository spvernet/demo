<?php

namespace App\Tests\Test\Unit\Domain\Usecase\UserChangePassword;


use App\Infrastructure\Repository\inMemory\UserRepository;
use PHPUnit\Framework\TestCase;

class UserChangePasswordTest extends TestCase
{

    public function testUserChangePasswordOK(){
        $this->markTestSkipped("Ejercicio bonus");

        $session_user_id=2; //variable de session

        $service = $this->getMockBuilder(UserAuthService::class)
            ->disableOriginalConstructor()
            ->setMethods(['getUserId'])
            ->getMock();

        $service
            ->expects($this->once())
            ->method('getUserId')
            ->willReturn($session_user_id);

        $result = $service->getUserId();
        $this->assertEquals($session_user_id,$result);

    }

    public function testUserChangePasswordKO(){
        $this->markTestSkipped("Ejercicio bonus");
        $session_user_id=2;

        $service = $this->getMockBuilder(UserAuthService::class)
            ->disableOriginalConstructor()
            ->setMethods(['getUserId'])
            ->getMock();

        $service
            ->expects($this->once())
            ->method('getUserId')
            ->willReturn(null);

        $result = $service->getUserId();
        $this->assertNotEquals($session_user_id,$result);

    }


    public function testUserPasswordChanged()
    {
        $this->markTestSkipped("Ejercicio bonus");

        $new_password = 'random';
        $user_id = 2;

        $service = $this->getMockBuilder(UserAuthService::class)
            ->disableOriginalConstructor()
            ->setMethods(['getUserId'])
            ->getMock();

        $service
            ->expects($this->once())
            ->method('getUserId')
            ->willReturn($user_id);

        $repository = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(['updatePassword'])
            ->getMock();


        $repository
            ->expects($this->once())
            ->method('updatePassword')
            ->with($this->equalTo([$user_id]),$this->equalTo([$new_password]))
            ->willReturn([]);


        $userValidation = new UserPasswordChangeUseCase(
            $new_password,
            $repository,
            $service,
            new UserPasswordChangedOutput(),
            new Logger()
        );

        /** @var JsonResponse $result */
        $result = $userValidation->execute();
        $response = json_decode($result->getContent(), true);

        $this->assertEquals([],$response);
    }

}