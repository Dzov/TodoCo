<?php

namespace App\Tests\UseCase\Task;

use App\Entity\Task\Task;
use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Entity\Task\TaskStub2;
use App\Tests\Doubles\Repository\Task\InMemoryTaskRepository;
use App\UseCase\Task\ToggleTaskPriority;
use PHPUnit\Framework\TestCase;

class ToggleTaskPriorityTest extends TestCase
{
    const INVALID_TASK_ID = -1;

    /**
     * @var ToggleTaskPriority
     */
    private $useCase;

    /**
     * @test
     */
    public function invalidTaskIdShouldThrowException()
    {
        $this->expectException('App\Exception\Task\TaskNotFoundException');
        $this->useCase->execute(self::INVALID_TASK_ID);
    }

    /**
     * @test
     */
    public function taskIsPriorityTrueExecuteShouldReturnTaskIsPriorityFalse()
    {
        /** @var Task $task */
        $task = $this->useCase->execute(TaskStub2::ID);

        $this->assertFalse($task->isPriority());
    }

    /**
     * @test
     */
    public function taskIsPriorityFalseExecuteShouldReturnTaskIsPriorityTrue()
    {
        /** @var Task $task */
        $task = $this->useCase->execute(TaskStub1::ID);

        $this->assertTrue($task->isPriority());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->useCase = new ToggleTaskPriority(
            new InMemoryTaskRepository(
                [
                    TaskStub1::ID => new TaskStub1(),
                    TaskStub2::ID => new TaskStub2(),
                ]
            )
        );
    }
}
