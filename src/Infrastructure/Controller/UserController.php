<?php

namespace App\Infrastructure\Controller;

use App\Domain\Usecase\UserValidation\UserValidationRequest;
use App\Domain\Usecase\UserValidation\UserValidationUseCase;

use App\Infrastructure\Output\UserValidationOutput;
use Symfony\Component\HttpFoundation\Request;

class UserController
{
    public function userValidation(Request $request)
    {
        $message = $request->getContent();
        $messageArray = json_decode($message, true);

        $request = new UserValidationRequest(
            "",
            ""
            );

        $usecase = new UserValidationUseCase(
            $request,
            new UserValidationOutput()
        );

        return $usecase->execute();
    }
}