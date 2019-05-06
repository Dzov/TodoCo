<?php

namespace App\Tests\Doubles\Entity\Task;

use App\Entity\Task\Task;
use App\Tests\Doubles\Entity\User\UserStub1;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class TaskStub1 extends Task
{
    const CONTENT     = 'task 1 - content';

    const CREATED_AT  = '2019-01-01';

    const ID          = 1;

    const IS_DONE     = true;

    const IS_PRIORITY = false;

    const TITLE       = 'Task 1 - title';

    protected $content = self::CONTENT;

    protected $id = self::ID;

    protected $isDone = self::IS_DONE;

    protected $isPriority = self::IS_PRIORITY;

    protected $title = self::TITLE;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable(self::CREATED_AT);
        $this->author = new UserStub1();
    }
}
