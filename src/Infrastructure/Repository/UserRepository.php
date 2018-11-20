<?php

namespace App\Infrastructure\Repository;


use App\Domain\Manager\UserRepositoryManagerInterface;

class UserRepository implements UserRepositoryManagerInterface
{
    const USERS_INFO = [
        ['id'=>1, 'username'=> 'test1', 'password'=>'', 'name' => 'Alex', 'surname'=> 'Gonzalez'],
        ['id'=>2, 'username'=> 'test2', 'password'=>'', 'name' => 'Pol', 'surname'=> 'Garcia'],
        ['id'=>3, 'username'=> 'test3', 'password'=>'', 'name' => 'Nil', 'surname'=> 'Marti'],
    ];

    /**
     * @param string $username
     * @param string $password
     */
    public function getUserInfo(string $username, string $password){


    }

}