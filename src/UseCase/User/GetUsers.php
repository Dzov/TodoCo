<?php

namespace App\UseCase\User;

use App\Repository\UserRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetUsers extends AbstractUserUseCase
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function execute()
    {
        return $this->repository->findAll();
    }
}
