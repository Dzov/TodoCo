<?php

namespace App\Tests\Security\VoterService;

use App\Security\VoterService\Task\CanUserDeleteTaskVoterService;
use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Entity\User\UserStub2;
use App\Tests\Doubles\Repository\Task\InMemoryTaskRepository;
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
        $this->assertFalse($this->voterService->canUserDeleteTask(new UserStub1(), self::INVALID_TASK_ID));
    }

    /**
     * @test
     */
    public function isTaskAuthorShouldReturnTrue()
    {
        $this->assertTrue($this->voterService->canUserDeleteTask(new UserStub1(), TaskStub1::ID));
    }

    /**
     * @test
     */
    public function isNotTaskAuthorShouldReturnFalse()
    {
        $this->assertFalse($this->voterService->canUserDeleteTask(new UserStub2(), TaskStub1::ID));
    }

    protected function setUp()
    {
        parent::setUp();

        $this->voterService = new CanUserDeleteTaskVoterService(
            new InMemoryTaskRepository([TaskStub1::ID => new TaskStub1()])
        );
    }
}
