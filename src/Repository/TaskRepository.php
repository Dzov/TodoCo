<?php

namespace App\Repository;

use App\Entity\Task\Task;
use App\Exception\Task\TaskNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findAll(array $filters = [], array $sort = [])
    {
        return $this->createQueryBuilder('t')
            ->addOrderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws TaskNotFoundException
     */
    public function findById(int $id)
    {
        try {
            return $this->createQueryBuilder('t')
                ->andWhere('t.id = :id')
                ->setParameter(':id', $id)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            throw new TaskNotFoundException();
        } catch (NonUniqueResultException $e) {
        }
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(Task $task)
    {
        $this->_em->remove($task);
        $this->_em->flush($task);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insert(Task $task)
    {
        $this->_em->persist($task);
        $this->_em->flush($task);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Task $task)
    {
        $this->_em->flush($task);
    }
}
