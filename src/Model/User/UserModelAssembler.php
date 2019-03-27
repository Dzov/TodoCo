<?php

namespace App\Model\User;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserModelAssembler
{
    public function createFromEntity(UserInterface $user): UserModel
    {
        $model = new UserModel();
        $model->setEmail($user->getEmail());
        $model->setId($user->getId());
        $model->setPassword($user->getPassword());
        $model->setUsername($user->getUsername());
        $model->setAdmin($user->isAdmin());

        return $model;
    }
}
