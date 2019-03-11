<?php

namespace App\Tests\UseCase\Task\Admin;

use App\Tests\Doubles\Task\Entity\TaskStub1;
use App\Tests\Doubles\Task\Repository\InMemoryTaskRepository;
use App\Tests\UseCase\Task\AssertTaskTrait;
use App\UseCase\Task\Admin\GetTasks;
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
