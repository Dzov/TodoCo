<?php

namespace App\UseCase\Dashboard;

use App\Entity\Task\Task;
use App\Entity\Task\TaskFilter;
use App\Repository\Task\TaskRepository;
use App\UseCase\Task\GetTasks;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetDashboardWithUserInformation
{
    /**
     * @var GetTasks
     */
    private $getTasksUseCase;

    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(TaskRepository $repository, GetTasks $useCase)
    {
        $this->taskRepository = $repository;
        $this->getTasksUseCase = $useCase;
    }

    public function execute(int $userId)
    {
        $tasks = $this->getUserTasks($userId);

        return $this->sortTasks($tasks);
    }

    private function getUserTasks(int $userId)
    {
        return $this->getTasksUseCase->execute([TaskFilter::AUTHOR => $userId]);
    }

    private function sortTasks(array $tasks): array
    {
        $tasksInProgress = [];
        $tasksStarred = [];
        $tasksClosed = [];

        $metrics = [];

        /** @var Task $task */
        foreach ($tasks as $task) {
            if ($task->isPriority()) {
                $tasksStarred[] = $task;
            }

            if (!$task->isDone()) {
                $tasksInProgress[] = $task;
            }

            if ($task->isDone()) {
                $tasksClosed[] = $task;
            }
        }

        $metrics['tasksInProgress'] = count($tasksInProgress);
        $metrics['tasksClosed'] = count($tasksClosed);
        $metrics['tasksCreated'] = count($tasks);

        return [$tasksInProgress, $tasksStarred, $metrics];
    }
}
