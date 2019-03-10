<?php

namespace App\UseCase\Task;

use App\Tests\Doubles\Task\Entity\TaskStub1;
use App\Tests\Doubles\Task\Repository\InMemoryTaskRepository;
use PHPUnit\Framework\TestCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateTaskTest extends TestCase
{
    /**
     * @var CreateTask
     */
    private $useCase;

    /**
     * @test
     */
    public function validUserExecuteShouldInsertUser()
    {
        $this->useCase->execute(new TaskStub1());

        $this->assertNotEmpty(InMemoryTaskRepository::$result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new CreateTask(new InMemoryTaskRepository([]));
    }
}
