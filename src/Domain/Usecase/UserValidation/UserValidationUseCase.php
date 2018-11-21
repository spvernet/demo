<?php

namespace App\Domain\Usecase\UserValidation;

use App\Domain\Core\AbstractOutput;
use App\Domain\Core\AbstractUsecase;
use App\Domain\Manager\UserRepositoryManagerInterface;
use App\Infrastructure\Output\UserValidationOutput;
use Psr\Log\LoggerInterface;

class UserValidationUseCase extends AbstractUsecase
{

    /** @var UserValidationRequest */
    protected  $userValidationRequest;

    /** @var UserRepositoryManagerInterface */
    protected $repository;

    /** @var UserValidationOutput  */
    protected $output;

    protected $logger;

    public function __construct(UserValidationRequest $userValidationRequest,
                                UserRepositoryManagerInterface $repository,
                                UserValidationOutput $output,
                                LoggerInterface $logger
    )
    {
        $this->userValidationRequest = $userValidationRequest;
        $this->repository = $repository;
        $this->output = $output;
        $this->logger = $logger;
    }

    public function execute (){


        if (!$this->userValidationRequest->isValid()) {
            $this->logger->error('field or value field not allowed', ['user.validation']);
            $this->output->addError('field or value field not allowed', 'user.validation', AbstractOutput::CODE_BAD_REQUEST);
            return $this->output->execute();
        }

        $user = $this->repository->getUserInfo(
            $this->userValidationRequest->getUsername(),
            $this->userValidationRequest->getPassword()
            );

        if (is_null($user)) {
            $this->logger->error('User or password incorrect',['user.validation']);
            $this->output->addError('User or password incorrect','user.validation', AbstractOutput::CODE_NOT_FOUND);
            return $this->output->execute();
        }

        return $this->output->execute($user);
    }
}