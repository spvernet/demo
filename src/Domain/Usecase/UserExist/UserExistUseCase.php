<?php

namespace App\Domain\Usecase\UserExist;


use App\Domain\Core\AbstractOutput;
use App\Domain\Core\AbstractUsecase;
use App\Domain\Manager\UserRepositoryManagerInterface;
use App\Infrastructure\Exception\UserExistException;
use Psr\Log\LoggerInterface;

class UserExistUseCase extends AbstractUsecase
{

    /** @var string  */
    protected $username;

    /** @var UserRepositoryManagerInterface */
    protected $repository;

    /** @var AbstractOutput  */
    protected $output;

    /** @var LoggerInterface  */
    protected $logger;

    public function __construct(string $username = "", UserRepositoryManagerInterface $repository, AbstractOutput $output, LoggerInterface $logger)
    {
        $this->username = $username;
        $this->repository = $repository;
        $this->output = $output;
        $this->logger = $logger;
    }

    public function execute()
    {
        $exist = $this->repository->exist($this->username);

        if (!$exist) {
            $this->logger->error('The username: '.$this->username.' doesn\'t exist ', ['user.exist']);
            $this->output->addError('The username: '.$this->username.' doesn\'t exist ', 'user.exist', AbstractOutput::CODE_NOT_FOUND);
        }

        return $this->output->execute([$exist]);
    }
}