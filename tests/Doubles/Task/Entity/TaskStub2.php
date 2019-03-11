<?php

namespace App\Tests\Doubles\Task\Entity;

use App\Entity\Task;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class TaskStub2 extends Task
{
    const CONTENT    = 'content - stub 2';

    const CREATED_AT = '2019-02-02';

    const ID         = 2;

    const IS_DONE    = false;

    const TITLE      = 'title - stub 2';

    protected $content = self::CONTENT;

    protected $id = self::ID;

    protected $isDone = self::IS_DONE;

    protected $title = self::TITLE;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable(self::CREATED_AT);
    }
}
