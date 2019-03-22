<?php

namespace App\Tests\UseCase\Task;

use App\Entity\Task;
use App\Model\Task\TaskModel;
use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Entity\Task\TaskStub2;
use App\Tests\Doubles\Model\Task\InvalidTaskModelStub1;
use App\Tests\Doubles\Model\Task\TaskModelStub1;
use App\Tests\Doubles\Repository\Task\InMemoryTaskRepository;
use App\UseCase\Task\EditTask;
use PHPUnit\Framework\TestCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class EditTaskTest extends TestCase
{
    use AssertTaskTrait;

    const UNKNOWN_TASK_ID = -1;

    /**
     * @var EditTask
     */
    private $useCase;

    /**
     * @test
     */
    public function withInvalidIdExecuteShouldThrowException()
    {
        $this->expectException('App\Exception\Task\TaskNotFoundException');
        $this->useCase->execute(new InvalidTaskModelStub1());
    }

    /**
     * @test
     */
    public function withValidTaskUpdateShouldUpdateTask()
    {
        $model = new TaskModelStub1();
        $model->setContent(TaskStub2::CONTENT);
        $model->setTitle(TaskStub2::TITLE);

        $this->useCase->execute($model);

        $expected = $this->buildExpectedTask($model);

        $this->assertTask($expected, InMemoryTaskRepository::$result[TaskStub1::ID]);
    }

    private function buildExpectedTask(TaskModel $model): Task
    {
        $expected = new TaskStub1();
        $expected->setTitle($model->getTitle());
        $expected->setContent($model->getContent());

        return $expected;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new EditTask(new InMemoryTaskRepository([TaskStub1::ID => new TaskStub1()]));
    }
}
