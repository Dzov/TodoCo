<?php

namespace App\Tests\Doubles\Model\User;

use App\Model\User\UserModel;
use App\Tests\Doubles\Entity\User\UserStub2;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserModelStub2 extends UserModel
{
    const EMAIL    = UserStub2::EMAIL;

    const ID       = UserStub2::ID;

    const IS_ADMIN = false;

    const PASSWORD = UserStub2::PASSWORD;

    const USERNAME = UserStub2::USERNAME;

    public $admin = self::IS_ADMIN;

    public $email = self::EMAIL;

    public $id = self::ID;

    public $password = self::PASSWORD;

    public $username = self::USERNAME;
}
