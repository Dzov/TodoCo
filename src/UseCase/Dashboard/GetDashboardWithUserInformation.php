<?php

namespace App\UseCase\Dashboard;

use App\Entity\Task\Task;
use App\Entity\Task\TaskFilter;
use App\UseCase\Task\GetTasks;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetDashboardWithUserInformation
{
    public const TASKS_CLOSED      = 'tasksClosed';

    public const TASKS_CREATED     = 'tasksCreated';

    public const TASKS_IN_PROGRESS = 'tasksInProgress';

    /**
     * @var GetTasks
     */
    private $getTasksUseCase;

    public function __construct(GetTasks $useCase)
    {
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

        $metrics[self::TASKS_IN_PROGRESS] = count($tasksInProgress);
        $metrics[self::TASKS_CLOSED] = count($tasksClosed);
        $metrics[self::TASKS_CREATED] = count($tasks);

        return [$tasksInProgress, $tasksStarred, $metrics];
    }
}
