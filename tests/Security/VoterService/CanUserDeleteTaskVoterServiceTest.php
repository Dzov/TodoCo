<?php

namespace App\Tests\Security\VoterService;

use App\Entity\Security\Roles;
use App\Security\VoterService\Task\CanUserDeleteTaskVoterService;
use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Entity\Task\TaskStub2;
use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Entity\User\UserStub2;
use App\Tests\Doubles\Repository\Task\InMemoryTaskRepository;
use App\Tests\Doubles\Repository\User\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

class CanUserDeleteTaskVoterServiceTest extends TestCase
{
    const INVALID_TASK_ID = -1;

    /**
     * @var CanUserDeleteTaskVoterService
     */
    private $voterService;

    /**
     * @test
     */
    public function taskNotFoundShouldReturnFalse()
    {
        $this->assertFalse($this->voterService->canUserDeleteTask(UserStub1::ID, self::INVALID_TASK_ID));
    }

    /**
     * @test
     */
    public function isTaskAuthorShouldReturnTrue()
    {
        $this->assertTrue($this->voterService->canUserDeleteTask(UserStub1::ID, TaskStub1::ID));
    }

    /**
     * @test
     */
    public function userIsAdminAndTaskAuthorIsAnonUserShouldReturnTrue()
    {
        InMemoryTaskRepository::$tasks = [TaskStub2::ID => new TaskStub2()];
        $user = new UserStub1([Roles::ROLE_ADMIN]);
        InMemoryUserRepository::$result = [
            $user->getId() => $user,
            UserStub2::ID  => new UserStub2([Roles::ROLE_ANONYMOUS_USER]),
        ];

        $this->assertTrue($this->voterService->canUserDeleteTask($user->getId(), TaskStub2::ID));
    }

    /**
     * @test
     */
    public function isNotTaskAuthorShouldReturnFalse()
    {
        $this->assertFalse($this->voterService->canUserDeleteTask(UserStub2::ID, TaskStub1::ID));
    }

    protected function setUp()
    {
        parent::setUp();

        $this->voterService = new CanUserDeleteTaskVoterService(
            new InMemoryTaskRepository([TaskStub1::ID => new TaskStub1()]),
            new InMemoryUserRepository([UserStub1::ID => new UserStub1()])
        );
    }
}
