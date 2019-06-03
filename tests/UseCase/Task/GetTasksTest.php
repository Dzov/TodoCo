<?php

namespace App\Tests\UseCase\Task;

use App\Entity\Task\TaskFilter;
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

    const INVALID_FILTER = 'invalid-filter';

    /**
     * @var GetTasks
     */
    private $useCase;

    /**
     * @test
     */
    public function withoutFiltersExecuteShouldReturnAllTasks()
    {

        $tasks = $this->useCase->execute();

        $this->assertTasks([new TaskStub1()], $tasks);
    }

    /**
     * @test
     */
    public function withFilterExecuteShouldReturnTasks()
    {
        $tasks = $this->useCase->execute([TaskFilter::STARRED]);

        $this->assertTasks([new TaskStub1()], $tasks);
    }

    /**
     * @test
     */
    public function withInvalidFiltersShouldThrowException()
    {
        $this->expectException('App\Exception\Task\InvalidTaskFilterException');
        $this->useCase->execute([self::INVALID_FILTER]);
    }

    protected function setUp(): void
    {
        $repository = new InMemoryTaskRepository([new TaskStub1()]);
        $this->useCase = new GetTasks($repository);
    }
}
