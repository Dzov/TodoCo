<?php

namespace App\Tests\Doubles\Repository\User;

use App\Entity\User\User;
use App\Exception\User\UserNotFoundException;
use App\Repository\User\UserRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class InMemoryUserRepository extends UserRepository
{
    /**
     * @var User[]
     */
    public static $result;

    /**
     * @param User[] $tasks
     */
    public function __construct(array $tasks)
    {
        self::$result = $tasks;
    }

    public function insert(User $user)
    {
        self::$result[] = $user;
    }

    public function findAll(array $filters = [], array $sorts = [])
    {
        return self::$result;
    }

    public function findById(int $id)
    {
        if (!isset(self::$result[$id])) {
            throw new UserNotFoundException();
        }

        return self::$result[$id];
    }

    public function delete(User $user)
    {
        unset(self::$result[$user->getId()]);
    }

    public function update(User $user)
    {
        self::$result[$user->getId()] = $user;
    }

    public function findByEmail(string $email)
    {
        foreach (self::$result as $user) {
            if ($email === $user->getEmail()) {
                return $user;
            }
        }

        throw new UserNotFoundException();
    }

    public function findByUsernameOrEmail(string $identifier)
    {
        foreach (self::$result as $user) {
            if ($identifier === $user->getEmail() || $identifier === $user->getUsername()) {
                return $user;
            }
        }

        throw new UserNotFoundException();
    }
}
