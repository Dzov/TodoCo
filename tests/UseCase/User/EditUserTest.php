<?php

namespace App\Tests\UseCase\User;

use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Entity\User\UserStub2;
use App\Tests\Doubles\Model\User\InvalidUserModelStub1;
use App\Tests\Doubles\Model\User\UserModelStub1;
use App\Tests\Doubles\Model\User\UserModelStub2;
use App\Tests\Doubles\Repository\User\InMemoryUserRepository;
use App\Tests\Doubles\Service\UserEmailServiceMock;
use App\Tests\Doubles\Service\UserPasswordEncoderMock;
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
    public function withValidModelExecuteShouldUpdateUser()
    {
        $model = new UserModelStub1();
        $model->setEmail(UserModelStub2::EMAIL);
        $model->setPassword(UserModelStub2::PASSWORD);
        $model->setUsername(UserModelStub2::USERNAME);

        $this->useCase->execute($model);

        $expected = new UserStub1();
        $expected->setEmail(UserStub2::EMAIL);
        $expected->setPassword(UserStub2::PASSWORD);
        $expected->setUsername(UserStub2::USERNAME);

        $this->assertUser($expected, InMemoryUserRepository::$result[UserStub1::ID]);
    }

    /**
     * @test
     */
    public function emailAlreadyExistsShouldThrowException()
    {
        $this->expectException('App\Exception\User\EmailAlreadyExistsException');
        InMemoryUserRepository::$result = [UserStub1::ID => new UserStub1(), UserStub2::ID => new UserStub2()];
        $model = new UserModelStub1();
        $model->setEmail(UserStub2::EMAIL);

        $this->useCase->execute($model);
    }

    protected function setUp()
    {
        parent::setUp();

        $userRepository = new InMemoryUserRepository(
            [
                UserStub1::ID => new UserStub1(),
            ]
        );

        $this->useCase = new EditUser(
            $userRepository,
            new UserPasswordEncoderMock(),
            new UserEmailServiceMock($userRepository)
        );
    }
}
