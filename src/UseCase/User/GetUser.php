<?php

namespace App\UseCase\User;

use App\Repository\UserRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetUser extends AbstractUserUseCase
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @throws \App\Exception\User\UserNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function execute(int $userId)
    {
        return $this->repository->findById($userId);
    }
}
