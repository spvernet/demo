<?php

namespace App\Infrastructure\Controller;

use App\Domain\Usecase\UserExist\UserExistUseCase;
use App\Domain\Usecase\UserValidation\UserValidationRequest;
use App\Domain\Usecase\UserValidation\UserValidationUseCase;

use App\Infrastructure\Output\UserExistOutput;
use App\Infrastructure\Output\UserValidationOutput;
use App\Infrastructure\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class UserController
{


    public function userExist(Request $request, UserRepository $userRepository){

        //die(var_dump('aqui'));
        $usecase = new UserExistUseCase(
            $request->get('username'),
            $userRepository,
            new UserExistOutput()
        );

        return $usecase->execute();
    }

    public function userValidation(Request $request)
    {
        $message = $request->getContent();
        $messageArray = json_decode($message, true);

        $command = new UserValidationRequest(
            "",
            ""
            );

        $usecase = new UserValidationUseCase(
            $command,
            new UserValidationOutput()
        );

        return $usecase->execute();
    }
}