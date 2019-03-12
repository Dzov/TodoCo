<?php

namespace App\Tests\Doubles\User\Entity;

use App\Entity\User;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserModelStub1 extends User
{
    const EMAIL    = UserStub1::EMAIL;

    const ID       = UserStub1::ID;

    const USERNAME = UserStub1::USERNAME;

    public $email = self::EMAIL;

    public $id = self::ID;

    public $username = self::USERNAME;
}
