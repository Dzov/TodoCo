<?php

namespace App\Tests\UseCase\User;

use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Repository\User\InMemoryUserRepository;
use App\UseCase\User\GetUser;
use PHPUnit\Framework\TestCase;

class GetUserTest extends TestCase
{
    use AssertUserTrait;

    const INVALID_USER_ID = -1;

    /**
     * @var GetUser
     */
    private $useCase;

    /**
     * @test
     */
    public function withInvalidIdExecuteShouldThrowException()
    {
        $this->expectException('App\Exception\User\UserNotFoundException');

        $this->useCase->execute(self::INVALID_USER_ID);
    }

    /**
     * @test
     */
    public function withValidIdExecuteShouldReturnUser()
    {
        $actual = $this->useCase->execute(UserStub1::ID);

        $this->assertUser(new UserStub1(), $actual);
    }

    protected function setUp()
    {
        $this->useCase = new GetUser(new InMemoryUserRepository([UserStub1::ID => new UserStub1()]));
    }
}
