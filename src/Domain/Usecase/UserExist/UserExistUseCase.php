<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 20/11/2018
 * Time: 19:04
 */

namespace App\Domain\Usecase\UserExist;


use App\Domain\Core\AbstractOutput;
use App\Domain\Core\AbstractUsecase;
use App\Domain\Manager\UserRepositoryManagerInterface;
use App\Infrastructure\Exception\UserExistException;

class UserExistUseCase extends AbstractUsecase
{

    /** @var string  */
    protected $username;

    /** @var UserRepositoryManagerInterface */
    protected $repository;

    /** @var AbstractOutput  */
    protected $output;

    public function __construct(string $username = "", UserRepositoryManagerInterface $repository, AbstractOutput $output)
    {
        $this->username = $username;
        $this->repository = $repository;
        $this->output = $output;
    }

    public function execute()
    {
        $exist = $this->repository->exist($this->username);

        if (!$exist) {
            $this->output->addError('The username: '.$this->username.' doesn\'t exist ', 'user.exist', AbstractOutput::CODE_NOT_FOUND);
        }

        return $this->output->execute([$exist]);
    }
}