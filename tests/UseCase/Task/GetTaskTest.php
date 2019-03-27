<?php

namespace App\Tests\UseCase\Task;

use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Repository\Task\InMemoryTaskRepository;
use App\UseCase\Task\GetTask;
use PHPUnit\Framework\TestCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetTaskTest extends TestCase
{
    use AssertTaskTrait;

    const INVALID_TASK_ID = -1;

    /**
     * @var GetTask
     */
    private $useCase;

    /**
     * @test
     */
    public function withInvalidIdExecuteShouldThrowException()
    {
        $this->expectException('App\Exception\Task\TaskNotFoundException');
        $this->useCase->execute(self::INVALID_TASK_ID);
    }

    /**
     * @test
     */
    public function validIdExecuteShouldReturnTask()
    {
        $actual = $this->useCase->execute(TaskStub1::ID);

        $this->assertTask(new TaskStub1(), $actual);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->useCase = new GetTask(new InMemoryTaskRepository([TaskStub1::ID => new TaskStub1()]));
    }
}
