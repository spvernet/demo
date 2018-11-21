<?php

namespace App\Infrastructure\Repository;


use App\Domain\Manager\UserRepositoryManagerInterface;

class UserRepository implements UserRepositoryManagerInterface
{
    /** @var array $user_info */
    private $user_info;

    public function __construct()
    {
        $this->user_info = [
            [   'id'=>1,
                'username'=> 'test1',
                'password'=>password_hash('123456789', PASSWORD_DEFAULT),
                'name' => 'Alex',
                'surname'=> 'Gonzalez'
            ],
            [   'id'=>2,
                'username'=> 'test2',
                'password'=>password_hash('987654321', PASSWORD_DEFAULT),
                'name' => 'Pol',
                'surname'=> 'Garcia'
            ],
            [   'id'=>3,
                'username'=> 'test3',
                'password'=>password_hash('abcdefghi', PASSWORD_DEFAULT),
                'name' => 'Nil',
                'surname'=> 'Marti'
            ],
        ];
    }

    /** @param string $username */
    public function exist(string $username) {
        foreach ($this->user_info as $u) {
            if ($u['username'] == $username){
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $username
     * @param string $password
     */
    public function getUserInfo(string $username, string $password){
        foreach ($this->user_info as $u){
            if (($u['username'] == $username) && (password_verify($password, $u['password']))){
                return $u;
            }
        }

        return null;


    }

}