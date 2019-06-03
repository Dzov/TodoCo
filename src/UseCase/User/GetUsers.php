<?php

namespace App\UseCase\User;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetUsers extends AbstractUserUseCase
{
    public function execute()
    {
        return $this->repository->findAll();
    }
}
