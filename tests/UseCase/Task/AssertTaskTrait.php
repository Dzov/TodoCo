<?php

namespace App\Tests\UseCase\Task;

use App\Entity\Task\Task;
use App\Tests\UseCase\User\AssertUserTrait;
use PHPUnit\Framework\Assert;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
trait AssertTaskTrait
{
    use AssertUserTrait;

    /**
     * @param Task[] $expected
     * @param Task[] $actual
     */
    public function assertTasks(array $expected, array $actual)
    {
        Assert::assertCount(count($expected), $actual);

        foreach ($expected as $key => $item) {
            $this->assertTask($item, $actual[$key]);
        }
    }

    public function assertTask(Task $expected, Task $actual)
    {
        Assert::assertSame($expected->getContent(), $actual->getContent());
        Assert::assertEquals($expected->getCreatedAt(), $actual->getCreatedAt());
        Assert::assertSame($expected->getTitle(), $actual->getTitle());
        Assert::assertSame($expected->isDone(), $actual->isDone());
        Assert::assertSame($expected->getAuthorUsername(), $actual->getAuthorUsername());
        Assert::assertSame($expected->getAuthorId(), $actual->getAuthorId());
        $this->assertUser($expected->getAuthor(), $actual->getAuthor());
    }
}
