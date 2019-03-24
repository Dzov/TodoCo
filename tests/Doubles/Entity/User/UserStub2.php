<?php

namespace App\Tests\Doubles\Entity\User;

use App\Entity\User\User;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserStub2 extends User
{
    const EMAIL    = 'stub2@email.com';

    const ID       = 2;

    const PASSWORD = 'passwordstub2';

    const USERNAME = 'username - stub 2';

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
