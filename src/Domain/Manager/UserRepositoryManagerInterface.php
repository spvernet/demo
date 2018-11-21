<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 20/11/2018
 * Time: 08:03
 */

namespace App\Domain\Manager;


interface UserRepositoryManagerInterface
{
    public function exist(string $username);

    public function getUserInfo(string $username, string $password);
}