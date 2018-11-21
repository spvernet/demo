<?php

namespace App\Domain\Usecase\UserValidation;


use App\Domain\Core\Request;

class UserValidationRequest implements Request
{

    /** @var string */
    private $username;

    /** @var string */
    private $password;


    public function __construct( string  $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }


    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


    public function isValid(): bool
    {
        return (!empty($this->username) && !empty($this->password));
    }

}