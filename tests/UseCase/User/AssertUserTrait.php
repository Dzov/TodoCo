<?php

namespace App\Tests\UseCase\User;

use App\Entity\User\User;
use PHPUnit\Framework\Assert;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
trait AssertUserTrait
{
    /**
     * @param User[] $expectedUsers
     * @param User[] $actualUsers
     */
    public function assertUsers(array $expectedUsers, array $actualUsers)
    {
        foreach ($expectedUsers as $key => $expectedUser) {
            $this->assertUser($expectedUser, $actualUsers[$key]);
        }
    }

    public function assertUser(User $expectedUser, User $actualUser)
    {
        Assert::assertSame($expectedUser->getId(), $actualUser->getId());
        Assert::assertSame($expectedUser->getEmail(), $actualUser->getEmail());
        Assert::assertSame($expectedUser->getUsername(), $actualUser->getUsername());
    }
}
