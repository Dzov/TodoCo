<?php

namespace App\Tests\Doubles\Entity\Task;

use App\Entity\Security\Roles;
use App\Entity\Task\Task;
use App\Tests\Doubles\Entity\User\UserStub2;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class TaskStub2 extends Task
{
    const CONTENT     = 'content - stub 2';

    const CREATED_AT  = '2019-02-02';

    const ID          = 2;

    const IS_DONE     = false;

    const IS_PRIORITY = true;

    const TITLE       = 'title - stub 2';

    protected $content = self::CONTENT;

    protected $id = self::ID;

    protected $isDone = self::IS_DONE;

    protected $isPriority = self::IS_PRIORITY;

    protected $title = self::TITLE;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable(self::CREATED_AT);
        $this->author = new UserStub2([Roles::ROLE_ANONYMOUS_USER]);
    }
}
