<?php

namespace App\Tests\Doubles\Service;

use App\Exception\User\EmailAlreadyExistsException;
use App\Service\User\UserEmailService;
use App\Tests\Doubles\Repository\User\InMemoryUserRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserEmailServiceMock extends UserEmailService
{
    public static $isAvailable;

    public function __construct(InMemoryUserRepository $repository)
    {
        parent::__construct($repository);
        self::$isAvailable = false;
    }

    public function checkEmailAvailability(string $email, int $userId = null)
    {
        if (!self::$isAvailable) {
            throw new EmailAlreadyExistsException;
        }
    }
}
