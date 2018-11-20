<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 11/20/18
 * Time: 10:16 AM
 */

namespace App\Domain\Core;


interface Request
{
    public function isValid(): bool;
}