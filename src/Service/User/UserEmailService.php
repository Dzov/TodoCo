<?php

namespace App\Service\User;

use App\Exception\User\EmailAlreadyExistsException;
use App\Exception\User\UserNotFoundException;
use App\Repository\UserRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserEmailService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws EmailAlreadyExistsException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function checkEmailAvailability(string $email, int $userId = null)
    {
        try {
            $user = $this->userRepository->findByEmail($email);
            if (null === $userId || $user->getId() !== $userId) {
                throw new EmailAlreadyExistsException();
            }
        } catch (UserNotFoundException $e) {
        }
    }
}
