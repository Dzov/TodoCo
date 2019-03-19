<?php

namespace App\Tests\Doubles\Model\User;

use App\Model\User\UserModel;
use App\Tests\Doubles\Entity\User\UserStub1;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserModelStub1 extends UserModel
{
    const EMAIL    = UserStub1::EMAIL;

    const ID       = UserStub1::ID;

    const PASSWORD = UserStub1::PASSWORD;

    const USERNAME = UserStub1::USERNAME;

    public $email = self::EMAIL;

    public $id = self::ID;

    public $password = self::PASSWORD;

    public $username = self::USERNAME;
}
