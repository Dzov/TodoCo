<?php

namespace App\Tests\Doubles\Security\Token;

use App\Entity\User\User;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class TokenStub1 extends AbstractToken
{
    public static $user;

    public function __construct(User $user)
    {
        self::$user = $user;
    }

    public function getUser()
    {
        return self::$user;
    }

    public function getCredentials()
    {
    }
}
