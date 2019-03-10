<?php

namespace App\UseCase\Task;

use App\Tests\Doubles\Task\Entity\TaskStub1;
use App\Tests\Doubles\Task\Repository\InMemoryTaskRepository;
use PHPUnit\Framework\TestCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class DeleteTaskTest extends TestCase
{
    const UNKNOWN_TASK_ID = -1;

    /**
     * @var DeleteTask
     */
    private $useCase;

    /**
     * @test
     */
    public function unknownUserIdExecuteShouldThrowException()
    {
        $this->expectException('\App\Exception\Task\TaskNotFoundException');
        $this->useCase->execute(self::UNKNOWN_TASK_ID);
    }

    /**
     * @test
     */
    public function userExistsExecuteShouldDeleteTask()
    {
        $this->useCase->execute(TaskStub1::ID);

        $this->assertEmpty(InMemoryTaskRepository::$result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new DeleteTask(new InMemoryTaskRepository([TaskStub1::ID => new TaskStub1()]));
    }
}