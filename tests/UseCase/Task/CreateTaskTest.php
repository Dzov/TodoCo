<?php

namespace App\Tests\UseCase\Task;

use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Model\Task\TaskModelStub1;
use App\Tests\Doubles\Repository\Task\InMemoryTaskRepository;
use App\UseCase\Task\CreateTask;
use PHPUnit\Framework\TestCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateTaskTest extends TestCase
{
    use AssertTaskTrait;

    /**
     * @var CreateTask
     */
    private $useCase;

    /**
     * @test
     */
    public function validUserExecuteShouldInsertUser()
    {
        $this->useCase->execute(new TaskModelStub1());

        $this->assertNotEmpty(InMemoryTaskRepository::$result);
        $this->assertTask(new TaskStub1(), InMemoryTaskRepository::$result[0]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new CreateTask(new InMemoryTaskRepository([]));
    }
}
