<?php

namespace App\Tests\Doubles\Task\Entity;

use App\Entity\Task;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class TaskStub1 extends Task
{
    const CONTENT    = 'content - stub 1';

    const CREATED_AT = '2019-01-01';

    const ID         = 1;

    const IS_DONE    = true;

    const TITLE      = 'title - stub 1';

    protected $content = self::CONTENT;

    protected $id = self::ID;

    protected $isDone = self::IS_DONE;

    protected $title = self::TITLE;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable(self::CREATED_AT);
    }
}
