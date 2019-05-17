<?php

namespace App\UseCase\User;

use App\Repository\UserRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class AbstractUserUseCase
{
    /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
}
