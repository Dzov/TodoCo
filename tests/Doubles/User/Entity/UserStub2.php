<?php

namespace App\Tests\Doubles\User\Entity;

use App\Entity\User;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserStub2 extends User
{
    const EMAIL    = 'stub2@email.com';

    const ID       = 2;

    const USERNAME = 'username - stub 2';

    public $email = self::EMAIL;

    public $id = self::ID;

    public $username = self::USERNAME;
}
