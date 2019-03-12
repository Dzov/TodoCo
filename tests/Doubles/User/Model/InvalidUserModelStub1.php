<?php

namespace App\Tests\Doubles\User\Entity;

use App\Model\User\UserModel;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class InvalidUserModelStub1 extends UserModel
{
    const EMAIL    = '&@4.com';

    const ID       = -1;

    const USERNAME = null;

    public $email = self::EMAIL;

    public $id = self::ID;

    public $username = self::USERNAME;
}
