<?php

namespace App\Tests\Doubles\Security\Token;

use App\Tests\Doubles\Entity\Task\TaskStub1;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class InvalidTokenStub1 extends AbstractToken
{
    public static $user;

    public function __construct()
    {
        self::$user = new TaskStub1();
    }

    public function getUser()
    {
        return self::$user;
    }

    public function getCredentials()
    {
    }
}
