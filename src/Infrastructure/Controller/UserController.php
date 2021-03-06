<?php

namespace App\Infrastructure\Controller;

use App\Domain\Usecase\UserExist\UserExistUseCase;
use App\Domain\Usecase\UserValidation\UserValidationRequest;
use App\Domain\Usecase\UserValidation\UserValidationUseCase;

use App\Infrastructure\Output\UserExistOutput;
use App\Infrastructure\Output\UserValidationOutput;
use App\Infrastructure\Repository\inMemory\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class UserController
{

    public function userExist(Request $request, UserRepository $userRepository, LoggerInterface $logger)
    {
        $usecase = new UserExistUseCase(
            $request->get('username'),
            $userRepository,
            new UserExistOutput(),
            $logger
        );

        return $usecase->execute();
    }

    public function userValidation(Request $request, UserRepository $userRepository, LoggerInterface $logger)
    {
        $messageArray = json_decode($request->getContent(), true);
        $username = $messageArray['username'] ?? "";
        $password = $messageArray['password'] ?? "";

        $command = new UserValidationRequest($username, $password);

        $usecase = new UserValidationUseCase(
            $command,
            $userRepository,
            new UserValidationOutput(),
            $logger
        );

        return $usecase->execute();
    }
}