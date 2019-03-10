<?php

namespace App\UseCase\Task;

use App\Tests\Doubles\Task\Entity\TaskStub1;
use App\Tests\Doubles\Task\Repository\InMemoryTaskRepository;
use PHPUnit\Framework\TestCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ToggleTaskTest extends TestCase
{
    const UNKNOWN_TASK_ID = -1;

    /**
     * @var ToggleTask
     */
    private $useCase;

    /**
     * @test
     */
    public function withUnknownTaskIdToggleStatusShouldThrowException()
    {
        $this->expectException('App\Exception\Task\TaskNotFoundException');

        $this->useCase->toggleStatus(self::UNKNOWN_TASK_ID);
    }

    /**
     * @test
     */
    public function withTaskToDoToggleStatusShouldReturnTaskDone()
    {
        $taskStub1 = new TaskStub1();
        $taskStub1->setIsDone(false);
        InMemoryTaskRepository::$result = [TaskStub1::ID => $taskStub1];

        $task = $this->useCase->toggleStatus(TaskStub1::ID);

        $this->assertTrue($task->getIsDone());
    }

    /**
     * @test
     */
    public function withTaskDoneToggleStatusShouldReturnTaskToDo()
    {
        $task = $this->useCase->toggleStatus(TaskStub1::ID);

        $this->assertFalse($task->getIsDone());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new ToggleTask(new InMemoryTaskRepository([TaskStub1::ID => new TaskStub1()]));
    }
}
