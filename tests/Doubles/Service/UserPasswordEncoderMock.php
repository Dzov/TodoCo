<?php

namespace App\Tests\Doubles\Service;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserPasswordEncoderMock implements UserPasswordEncoderInterface
{
    public function encodePassword(UserInterface $user, $plainPassword)
    {
        return md5($plainPassword);
    }

    public function isPasswordValid(UserInterface $user, $raw)
    {
        return true;
    }
}
