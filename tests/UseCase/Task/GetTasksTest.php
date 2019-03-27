<?php

namespace App\Tests\UseCase\Task;

use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Repository\Task\InMemoryTaskRepository;
use App\UseCase\Task\GetTasks;
use PHPUnit\Framework\TestCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetTasksTest extends TestCase
{
    use AssertTaskTrait;

    /**
     * @var GetTasks
     */
    private $getTasks;

    /**
     * @test
     */
    public function withoutFiltersExecuteShouldReturnAllTasks()
    {
        $tasks = $this->getTasks->execute();

        $this->assertTasks([new TaskStub1()], $tasks);
    }

    protected function setUp(): void
    {
        $repository = new InMemoryTaskRepository([new TaskStub1()]);
        $this->getTasks = new GetTasks($repository);
    }
}
