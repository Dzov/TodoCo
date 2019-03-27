<?php

namespace App\Tests\Model\Task;

use App\Model\Task\TaskModelAssembler;
use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\UseCase\Task\AssertTaskTrait;
use PHPUnit\Framework\TestCase;

class TaskModelAssemblerTest extends TestCase
{
    use AssertTaskTrait;

    /**
     * @var TaskModelAssembler
     */
    private $assembler;

    /**
     * @test
     */
    public function createFromEntity()
    {
        $expected = new TaskStub1();
        $actual = $this->assembler->createFromEntity($expected);

        $this->assertSame($expected->getId(), $actual->getId());
        $this->assertSame($expected->getTitle(), $actual->getTitle());
        $this->assertSame($expected->getIsDone(), $actual->isDone());
        $this->assertSame($expected->getCreatedAt(), $actual->getCreatedAt());
        $this->assertSame($expected->getContent(), $actual->getContent());
        $this->assertSame($expected->getAuthorId(), $actual->getAuthorId());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->assembler = new TaskModelAssembler();
    }
}
