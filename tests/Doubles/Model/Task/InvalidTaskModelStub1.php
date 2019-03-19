<?php

namespace App\Tests\Doubles\Model\Task;

use App\Model\Task\TaskModel;
use App\Tests\Doubles\Entity\Task\TaskStub2;

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

    protected $content = self::CONTENT;

    protected $id = self::ID;

    protected $isDone = self::IS_DONE;

    protected $title = self::TITLE;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable(self::CREATED_AT);
    }
}
