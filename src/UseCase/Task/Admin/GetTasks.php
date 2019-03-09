<?php

namespace App\UseCase\Task\Admin;

use App\Repository\TaskRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetTasks
{
    public function execute(array $filters = [], TaskRepository $repository)
    {
        return $repository->findAll();
    }
}
