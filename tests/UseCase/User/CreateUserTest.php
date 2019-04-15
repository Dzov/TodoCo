<?php

namespace App\Tests\UseCase\User;

use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Model\User\UserModelStub1;
use App\Tests\Doubles\Repository\User\InMemoryUserRepository;
use App\Tests\Doubles\Service\UserEmailServiceMock;
use App\Tests\Doubles\Service\UserPasswordEncoderMock;
use App\UseCase\User\CreateUser;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    use AssertUserTrait;

    /**
     * @var CreateUser
     */
    private $useCase;

    /**
     * @test
     */
    public function withValidModelExecuteShouldCreateUser()
    {
        UserEmailServiceMock::$isAvailable = true;
        $this->useCase->execute(new UserModelStub1());

        $actualUser = InMemoryUserRepository::$result[0];
        $expectedUser = new UserStub1();
        $this->assertSame($expectedUser->getEmail(), $actualUser->getEmail());
        $this->assertSame($expectedUser->getPassword(), $actualUser->getPassword());
    }

    /**
     * @test
     */
    public function withAlreadyExistingEmailExecuteShouldThrowException()
    {
        $this->expectException('App\Exception\User\EmailAlreadyExistsException');
        InMemoryUserRepository::$result = [UserStub1::ID => new UserStub1()];

        $this->useCase->execute(new UserModelStub1());
    }

    protected function setUp()
    {
        parent::setUp();

        $userRepository = new InMemoryUserRepository([]);
        $this->useCase = new CreateUser(
            $userRepository,
            new UserPasswordEncoderMock(),
            new UserEmailServiceMock($userRepository)
        );
    }
}
