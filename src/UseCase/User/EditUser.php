<?php

namespace App\UseCase\User;

use App\Entity\User\User;
use App\Model\User\UserModel;
use App\Repository\User\UserRepository;
use App\Service\User\UserEmailService;
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

    /**
     * @var UserEmailService
     */
    private $userEmailService;

    public function __construct(
        UserRepository $repository,
        UserPasswordEncoderInterface $encoder,
        UserEmailService $emailService
    ) {
        parent::__construct($repository);

        $this->passwordEncoder = $encoder;
        $this->userEmailService = $emailService;
    }

    /**
     * @throws \App\Exception\User\EmailAlreadyExistsException
     * @throws \App\Exception\User\UserNotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function execute(UserModel $model): void
    {
        $user = $this->getUser($model);
        $this->checkEmailAvailability($model, $user);

        $updatedUser = $this->updateProperties($model, $user);

        $this->repository->update($updatedUser);
    }

    private function updateProperties(UserModel $model, User $user): User
    {
        $user->setAdmin($model->isAdmin());
        $user->setEmail($model->getEmail());
        if ($user->getPassword() !== $model->getPassword()) {
            $user->setPassword($this->getEncodedPassword($user, $model->getPassword()));
        }
        $user->setUsername($model->getUsername());

        return $user;
    }

    private function getEncodedPassword(User $user, string $password): string
    {
        return $this->passwordEncoder->encodePassword($user, $password);
    }

    /**
     * @throws \App\Exception\User\UserNotFoundException
     */
    protected function getUser(UserModel $model): User
    {
        return $this->repository->findById($model->getId());
    }

    /**
     * @throws \App\Exception\User\EmailAlreadyExistsException
     */
    protected function checkEmailAvailability(UserModel $model, User $user): void
    {
        $this->userEmailService->checkEmailAvailability($model->getEmail(), $user->getId());
    }
}
