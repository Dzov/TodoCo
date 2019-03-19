<?php

namespace App\Tests\Service\User;

use App\Service\User\UserEmailService;
use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Model\User\UserModelStub1;
use App\Tests\Doubles\Repository\User\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

class UserEmailServiceTest extends TestCase
{
    /**
     * @var UserEmailService
     */
    private $service;

    /**
     * @test
     */
    public function emailIsAlreadyTakenShouldThrowException()
    {
        $this->expectException('App\Exception\User\EmailAlreadyExistsException');
        $this->service->checkEmailAvailability(UserModelStub1::EMAIL);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->service = new UserEmailService(new InMemoryUserRepository([UserStub1::ID => new UserStub1()]));
    }
}
