<?php

namespace App\Tests\Doubles\Model\Task;

use App\Model\Task\TaskModel;
use App\Tests\Doubles\Entity\Task\TaskStub2;
use App\Tests\Doubles\Entity\User\UserStub1;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class InvalidTaskModelStub1 extends TaskModel
{
    const CONTENT    = TaskStub2::CONTENT;

    const CREATED_AT = TaskStub2::CREATED_AT;

    const ID         = -1;

    const IS_DONE    = TaskStub2::IS_DONE;

    const TITLE      = TaskStub2::TITLE;

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
