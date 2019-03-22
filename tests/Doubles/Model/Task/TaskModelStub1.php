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
    const AUTHOR     = UserStub1::ID;

    const CONTENT    = TaskStub1::CONTENT;

    const CREATED_AT = TaskStub1::CREATED_AT;

    const ID         = TaskStub1::ID;

    const IS_DONE    = TaskStub1::IS_DONE;

    const TITLE      = TaskStub1::TITLE;

    protected $author = self::AUTHOR;

    protected $content = self::CONTENT;

    protected $id = self::ID;

    protected $isDone = self::IS_DONE;

    protected $title = self::TITLE;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable(self::CREATED_AT);
    }
}
