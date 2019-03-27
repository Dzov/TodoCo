<?php

namespace App\Tests\Doubles\Service;

use App\Service\User\UserEmailService;
use App\Tests\Doubles\Repository\User\InMemoryUserRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserEmailServiceMock extends UserEmailService
{
    public function __construct(InMemoryUserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function checkEmailAvailability(string $email, int $userId = null)
    {
        parent::checkEmailAvailability($email, $userId);
    }
}
