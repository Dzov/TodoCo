<?php

namespace App\Tests\UseCase\Task;

use App\Tests\Doubles\Task\Entity\TaskStub1;
use App\Tests\Doubles\Task\Entity\TaskStub2;
use App\Tests\Doubles\Task\Repository\InMemoryTaskRepository;
use App\UseCase\Task\UpdateTask;
use PHPUnit\Framework\TestCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UpdateTaskTest extends TestCase
{
    use AssertTaskTrait;

    /**
     * @var UpdateTask
     */
    private $useCase;

    /**
     * @test
     */
    public function withValidTaskUpdateShouldUpdateTask()
    {
        $expected = new TaskStub1();
        $expected->setIsDone(TaskStub2::IS_DONE);
        $expected->setContent(TaskStub2::CONTENT);
        $expected->setCreatedAt(TaskStub2::CREATED_AT);
        $expected->setTitle(TaskStub2::TITLE);

        $actual = $this->useCase->updateTask(TaskStub1::ID, $expected);

        $this->assertTask($expected, $actual);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new UpdateTask(new InMemoryTaskRepository([TaskStub1::ID => new TaskStub1()]));
    }
}
