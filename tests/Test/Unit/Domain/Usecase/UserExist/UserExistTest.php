<?php

namespace App\Tests\Test\Unit\Domain\Usecase\UserExist;


use App\Domain\Core\AbstractOutput;
use App\Domain\Usecase\UserExist\UserExistUseCase;
use App\Infrastructure\Output\UserExistOutput;
use App\Infrastructure\Repository\inMemory\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Log\Logger;

class UserExistTest extends TestCase
{

    public function testUserNotFound()
    {
        $repository = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(['exist'])
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('exist')
            ->willReturn(false)
        ;

        $userValidation = new UserExistUseCase(
            'test10',
            $repository,
            new UserExistOutput(),
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
        $repository = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(['exist'])
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('exist')
            ->willReturn(true)
        ;

        $userValidation = new UserExistUseCase(
            'test10',
            $repository,
            new UserExistOutput(),
            new Logger()
        );

        /** @var JsonResponse $result */
        $result = $userValidation->execute();
        $response = json_decode($result->getContent(), true);

        $this->assertEquals([],$response['metadata']);
        $this->assertEquals( true, $response['data']['is_valid']);
    }

}