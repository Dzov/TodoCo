<?php

namespace App\Tests\UseCase\Task;

use App\Entity\Task;
use App\Form\Task\Model\TaskModel;
use App\Tests\Doubles\Task\Entity\TaskStub1;
use App\Tests\Doubles\Task\Entity\TaskStub2;
use App\Tests\Doubles\Task\Model\InvalidTaskModelStub1;
use App\Tests\Doubles\Task\Model\TaskModelStub1;
use App\Tests\Doubles\Task\Repository\InMemoryTaskRepository;
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
        $this->useCase->updateTask(new InvalidTaskModelStub1());
    }

    /**
     * @test
     */
    public function withValidTaskUpdateShouldUpdateTask()
    {
        $model = new TaskModelStub1();
        $model->setContent(TaskStub2::CONTENT);
        $model->setTitle(TaskStub2::TITLE);

        $this->useCase->updateTask($model);

        $expected = $this->getExpectedTask($model);

        $this->assertTask($expected, InMemoryTaskRepository::$result[TaskStub1::ID]);
    }

    private function getExpectedTask(TaskModel $model): Task
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
