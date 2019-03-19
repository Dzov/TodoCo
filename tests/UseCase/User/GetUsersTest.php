<?php

namespace App\Tests\UseCase\User;

use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Entity\User\UserStub2;
use App\Tests\Doubles\Repository\User\InMemoryUserRepository;
use App\UseCase\User\GetUsers;
use PHPUnit\Framework\TestCase;

class GetUsersTest extends TestCase
{
    use AssertUserTrait;

    /**
     * @var GetUsers
     */
    private $useCase;

    /**
     * @test
     */
    public function executeShouldReturnUsers()
    {
        $expectedUsers = [
            UserStub1::ID => new UserStub1(),
            UserStub2::ID => new UserStub2(),
        ];

        $actualUsers = $this->useCase->execute();

        $this->assertUsers($expectedUsers, $actualUsers);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->useCase = new GetUsers(
            new InMemoryUserRepository(
                [
                    UserStub1::ID => new UserStub1(),
                    UserStub2::ID => new UserStub2(),
                ]
            )
        );
    }
}
