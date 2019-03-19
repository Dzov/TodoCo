<?php

namespace App\UseCase\User;

use App\Entity\User;
use App\Model\User\UserModel;
use App\Repository\UserRepository;
use App\Service\User\UserEmailService;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateUser extends AbstractUserUseCase
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

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

        $this->encoder = $encoder;
        $this->userEmailService = $emailService;
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \App\Exception\User\EmailAlreadyExistsException
     */
    public function execute(UserModel $model)
    {
        $this->userEmailService->checkEmailAvailability($model->getEmail());

        $user = $this->populateUser($model);

        $this->repository->insert($user);
    }

    private function populateUser(UserModel $model): User
    {
        $user = new User();
        $user->setUsername($model->getUsername());
        $user->setEmail($model->getEmail());
        $user->setPassword($this->encoder->encodePassword($user, $model->getPassword()));

        return $user;
    }
}
