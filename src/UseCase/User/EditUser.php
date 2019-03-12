<?php

namespace App\UseCase\User;

use App\Entity\User;
use App\Model\User\UserModel;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class EditUser extends AbstractUserUseCase
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct($repository);

        $this->passwordEncoder = $encoder;
    }

    public function execute(UserModel $model): void
    {
        $user = $this->repository->findById($model->getId());

        $updatedUser = $this->updateProperties($model, $user);

        $this->repository->update($updatedUser);
    }

    private function updateProperties(UserModel $model, User $user): User
    {
        $user->setPassword($this->getEncodedPassword($user, $model->getPassword()));
        $user->setEmail($model->getEmail());
        $user->setUsername($model->getUsername());

        return $user;
    }

    private function getEncodedPassword(User $user, string $password): string
    {
        return $this->passwordEncoder->encodePassword($user, $password);
    }
}
