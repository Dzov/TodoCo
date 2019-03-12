<?php

namespace App\Tests\UseCase\User;

use App\Tests\Doubles\User\Entity\InvalidUserModelStub1;
use App\Tests\Doubles\User\Entity\UserStub1;
use App\Tests\Doubles\User\Repository\InMemoryUserRepository;
use App\UseCase\User\EditUser;
use PHPUnit\Framework\TestCase;

class EditUserTest extends TestCase
{
    use AssertUserTrait;

    const INVALID_USER_ID = -1;

    /**
     * @var EditUser
     */
    private $useCase;

    /**
     * @test
     */
    public function invalidIdExecuteShouldThrowException()
    {
        $this->expectException('App\Exception\User\UserNotFoundException');
        $this->useCase->execute(new InvalidUserModelStub1());
    }

    /**
     * @test
     */
    public function withValidIdExecuteShouldUpdateUser()
    {

    }

    protected function setUp()
    {
        parent::setUp();

        $this->useCase = new EditUser(
            new InMemoryUserRepository([UserStub1::ID => new UserStub1()]),

        );
    }
}
