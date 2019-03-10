<?php

namespace App\Repository;

use App\Entity\Task;
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
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Task $task)
    {
        $this->getEntityManager()->remove($task);
        $this->update();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insert(Task $task)
    {
        $this->getEntityManager()->persist($task);
        $this->update();
    }

    public function update()
    {
        $this->getEntityManager()->flush();
    }
}
