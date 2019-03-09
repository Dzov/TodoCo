<?php

namespace App\UseCase\Task\Admin;

use App\Tests\Doubles\Task\Entity\TaskStub1;
use App\Tests\Doubles\Task\Repository\InMemoryTaskRepository;
use App\Tests\UseCase\Task\TaskTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetTasksTest extends TestCase
{
    use TaskTrait;

    /**
     * @var GetTasks
     */
    private $getTasks;

    /**
     * @test
     */
    public function withoutFiltersExecuteShouldReturnUsersTasks()
    {
        $repository = new InMemoryTaskRepository([new TaskStub1()]);
        $tasks = $this->getTasks->execute([], $repository);

        $this->assertTasks([new TaskStub1()], $tasks);
    }

    protected function setUp(): void
    {
        $this->getTasks = new GetTasks();
    }
}
