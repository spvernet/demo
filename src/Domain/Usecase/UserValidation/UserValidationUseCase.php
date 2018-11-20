<?php

namespace App\Domain\Usecase\UserValidation;

use App\Domain\Core\AbstractUsecase;
use Symfony\Component\HttpFoundation\Response;

class UserValidationUseCase extends AbstractUsecase
{

    /** @var UserValidationRequest */
    private  $userValidationRequest;


    private $output;

    public function __construct(UserValidationRequest $userValidationRequest,
                                $output)
    {
        $this->userValidationRequest = $userValidationRequest;
        $this->output = $output;
    }

    public function execute (){
        return new Response(
            '<html><body>Hello World</body></html>'
        );
    }
}