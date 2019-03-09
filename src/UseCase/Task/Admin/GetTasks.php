<?php

namespace App\UseCase\Task\Admin;

use App\Repository\TaskRepository;

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

    public function execute(array $filters = [])
    {
        return $this->taskRepository->findAll();
    }
}
