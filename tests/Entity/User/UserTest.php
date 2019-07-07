<?php

namespace App\Tests\Entity\User;

use App\Entity\Security\Roles;
use App\Entity\User\User;
use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Entity\User\UserStub2;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    const IS_NOT_ADMIN = false;

    const IS_ADMIN     = true;

    /**
     * @test
     */
    public function setAdminTrueShouldAddRoleAdmin()
    {
        $user = new UserStub2([Roles::ROLE_USER]);

        $user->setAdmin(self::IS_ADMIN);

        $this->assertSame([Roles::ROLE_USER, Roles::ROLE_ADMIN], $user->getRoles());
    }

    /**
     * @test
     */
    public function setAdminFalseShouldRemoveRoleAdmin()
    {
        $user = new UserStub1([Roles::ROLE_USER, Roles::ROLE_ADMIN]);

        $user->setAdmin(self::IS_NOT_ADMIN);

        $this->assertSame([Roles::ROLE_USER], $user->getRoles());
    }

    /**
     * @test
     */
    public function anonymizeUserShouldAnonymizeUser()
    {
        $user = new UserStub1([Roles::ROLE_USER]);

        $user->anonymizeUser();

        $this->assertSame(User::ANONYMOUS_EMAIL, $user->getEmail());
        $this->assertSame(User::ANONYMOUS_USERNAME, $user->getUsername());
        $this->assertContains(Roles::ROLE_ANONYMOUS_USER, $user->getRoles());
    }

    /**
     * @test
     */
    public function withRoleAdminIsAdminShouldReturnTrue()
    {
        $expectedRoles = [Roles::ROLE_USER, Roles::ROLE_ADMIN];
        $user = new UserStub1($expectedRoles);

        $this->assertSame($expectedRoles, $user->getRoles());
        $this->assertTrue($user->isAdmin());
    }

    /**
     * @test
     */
    public function withoutRoleAdminIsAdminShouldReturnFalse()
    {
        $expectedRoles = [Roles::ROLE_USER];
        $user = new UserStub2($expectedRoles);

        $this->assertSame($expectedRoles, $user->getRoles());
        $this->assertFalse($user->isAdmin());
    }

    /**
     * @test
     */
    public function getSaltShouldReturnNull()
    {
        $user = new UserStub1([Roles::ROLE_USER]);
        $this->assertNull($user->getSalt());
    }
}
