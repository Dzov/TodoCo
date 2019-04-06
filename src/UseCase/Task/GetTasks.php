<?php

namespace App\UseCase\Task;

use App\Entity\Task\TaskFilter;
use App\Exception\Task\InvalidTaskFilterException;
use App\Repository\Task\TaskRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetTasks
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @throws InvalidTaskFilterException
     */
    public function execute(array $filters = [])
    {
        $this->checkInvalidFilters($filters);

        return $this->taskRepository->findAll($filters);
    }

    /**
     * @throws InvalidTaskFilterException
     */
    private function checkInvalidFilters(array $filters = [])
    {
        if (empty($filters)) {
            return;
        }

        $validFilters = [TaskFilter::COMPLETED, TaskFilter::STARRED, TaskFilter::IN_PROGRESS];

        foreach ($filters as $key => $filter) {
            if (!in_array($key, $validFilters)) {
                throw new InvalidTaskFilterException();
            }
        }
    }
}
