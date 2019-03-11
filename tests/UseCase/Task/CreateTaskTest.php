<?php

namespace App\Tests\UseCase\Task;

use App\Tests\Doubles\Task\Entity\TaskStub1;
use App\Tests\Doubles\Task\Model\TaskModelStub1;
use App\Tests\Doubles\Task\Repository\InMemoryTaskRepository;
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
