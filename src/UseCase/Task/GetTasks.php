<?php

namespace App\UseCase\Task;

use App\Entity\Task\TaskFilter;
use App\Exception\Task\InvalidTaskFilterException;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetTasks extends AbstractTaskUseCase
{
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

        $validFilters = TaskFilter::getTaskFilters();

        foreach ($filters as $key => $filter) {
            if (!in_array($filter, $validFilters) && TaskFilter::AUTHOR !== $key) {
                throw new InvalidTaskFilterException();
            }
        }
    }
}
