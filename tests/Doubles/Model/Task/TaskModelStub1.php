<?php

namespace App\Tests\Doubles\Model\Task;

use App\Model\Task\TaskModel;
use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Entity\User\UserStub1;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class TaskModelStub1 extends TaskModel
{
    const CONTENT    = TaskStub1::CONTENT;

    const CREATED_AT = TaskStub1::CREATED_AT;

    const ID         = TaskStub1::ID;

    const IS_DONE    = TaskStub1::IS_DONE;

    const TITLE      = TaskStub1::TITLE;

    public $content = self::CONTENT;

    public $id = self::ID;

    public $isDone = self::IS_DONE;

    public $title = self::TITLE;

    public function __construct()
    {
        $this->authorId = UserStub1::ID;
        $this->createdAt = new \DateTimeImmutable(self::CREATED_AT);
    }
}
