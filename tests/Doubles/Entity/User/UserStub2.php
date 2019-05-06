<?php

namespace App\Tests\Doubles\Entity\User;

use App\Entity\User\User;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserStub2 extends User
{
    const EMAIL    = 'user2@test.com';

    const ID       = 2;

    const PASSWORD = 'test';

    const USERNAME = 'UserStub2';

    public $email = self::EMAIL;

    public $id = self::ID;

    public $password = self::PASSWORD;

    public $roles = [];

    public $username = self::USERNAME;

    public function __construct(array $roles = [])
    {
        $this->roles = $roles;
    }
}
