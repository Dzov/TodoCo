<?php

namespace App\Tests\Doubles\Entity\User;

use App\Entity\User;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserStub1 extends User
{
    const EMAIL    = 'stub1@email.com';

    const ID       = 1;

    const PASSWORD = 'passwordstub1';

    const USERNAME = 'username - stub 1';

    public $email = self::EMAIL;

    public $id = self::ID;

    public $password = self::PASSWORD;

    public $username = self::USERNAME;

    public function __construct()
    {
        $this->password = md5(self::PASSWORD);
    }
}
