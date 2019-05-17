<?php

namespace App\Tests\Doubles\Entity\User;

use App\Entity\User\User;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserStub1 extends User
{
    const EMAIL    = 'user1@test.com';

    const ID       = 1;

    const PASSWORD = 'test';

    const USERNAME = 'UserStub1';

    public $email = self::EMAIL;

    public $id = self::ID;

    public $password = self::PASSWORD;

    public $roles = [];

    public $username = self::USERNAME;

    public function __construct(array $roles = [])
    {
        $this->password = md5(self::PASSWORD);
        $this->roles = $roles;
    }
}
