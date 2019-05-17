<?php

namespace App\Repository;

use App\Entity\Task\Task;
use App\Entity\Task\TaskFilter;
use App\Exception\Task\TaskNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
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

    public function findAll(array $filters = [], array $sorts = [])
    {
        $qb = $this->createQueryBuilder('t');

        $this->applyFilters($qb, $filters);

        $this->applySorts($sorts, $qb);

        return $qb->getQuery()->getResult();
    }

    private function applyFilters(QueryBuilder $qb, array $filters = [])
    {
        if (isset($filters[TaskFilter::COMPLETED])) {
            $qb->andWhere('t.isDone = true');
        }

        if (isset($filters[TaskFilter::IN_PROGRESS])) {
            $qb->andWhere('t.isDone = false');
        }

        if (isset($filters[TaskFilter::STARRED])) {
            $qb->andWhere('t.isPriority = true');
        }
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

    protected function applySorts(array $sort, QueryBuilder $qb): void
    {
        if (empty($sort)) {
            $qb->addOrderBy('t.isDone', 'ASC')
            ->addOrderBy('t.isPriority', 'DESC')
                ->addOrderBy('t.createdAt', 'DESC');
        }
    }
}
