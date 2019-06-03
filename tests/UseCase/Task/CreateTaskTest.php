<?php

namespace App\Tests\UseCase\Task;

use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Model\Task\TaskModelStub1;
use App\Tests\Doubles\Repository\Task\InMemoryTaskRepository;
use App\Tests\Doubles\Repository\User\InMemoryUserRepository;
use App\UseCase\Task\CreateTask;
use PHPUnit\Framework\TestCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateTaskTest extends TestCase
{
    use AssertTaskTrait;

    const INVALID_ID = -1;

    /**
     * @var CreateTask
     */
    private $useCase;

    /**
     * @test
     */
    public function validUserExecuteShouldInsertUser()
    {
        $this->useCase->execute(new TaskModelStub1(), UserStub1::ID);

        $this->assertNotEmpty(InMemoryTaskRepository::$tasks);
        $this->assertTask(new TaskStub1(), InMemoryTaskRepository::$tasks[0]);
    }

    /**
     * @test
     */
    public function userNotFoundShouldThrowException()
    {
        $this->expectException('App\Exception\User\UserNotFoundException');
        $model = new TaskModelStub1();
        $model->authorId = self::INVALID_ID;
        $this->useCase->execute($model);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new CreateTask(
            new InMemoryTaskRepository([]),
            new InMemoryUserRepository([UserStub1::ID => new UserStub1()])
        );
    }
}
