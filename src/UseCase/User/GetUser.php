<?php

namespace App\UseCase\User;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetUser extends AbstractUserUseCase
{
    /**
     * @throws \App\Exception\User\UserNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function execute(int $userId)
    {
        return $this->repository->findById($userId);
    }
}
