<?php

namespace App\Tests\Doubles\User\Repository;

use App\Entity\User;
use App\Exception\User\UserNotFoundException;
use App\Repository\UserRepository;

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
     * @param User[] $result
     */
    public function __construct(array $result)
    {
        self::$result = $result;
    }

    public function insert(User $user)
    {
        self::$result = [$user];
    }

    public function findAll(array $filters = [], array $sort = [])
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
}
