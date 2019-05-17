<?php

namespace App\Repository\User;

use App\Entity\User\User;
use App\Exception\User\UserNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAll(array $filters = [], array $sorts = [])
    {
        return $this->createQueryBuilder('u')
            ->addOrderBy('u.username', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws UserNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findById(int $id)
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.id = :id')
                ->setParameter(':id', $id)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            throw new UserNotFoundException();
        }
    }

    /**
     * @throws UserNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByUsernameOrEmail(string $identifier)
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.email = :identifier OR u.username = :identifier')
                ->setParameter(':identifier', $identifier)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            throw new UserNotFoundException();
        }
    }

    /**
     * @throws UserNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByEmail(string $email)
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.email = :email')
                ->setParameter(':email', $email)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            throw new UserNotFoundException();
        }
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(User $user)
    {
        $this->_em->remove($user);
        $this->_em->flush($user);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insert(User $user)
    {
        $this->_em->persist($user);
        $this->_em->flush($user);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(User $user)
    {
        $this->_em->flush($user);
    }
}
