<?php

namespace App\Model\Task;

use App\Entity\Task\Task;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class TaskModelAssembler
{
    public function createFromEntity(Task $task): TaskModel
    {
        $model = new TaskModel($task->getAuthorId());
        $model->setContent($task->getContent());
        $model->setCreatedAt($task->getCreatedAt());
        $model->setId($task->getId());
        $model->setIsDone($task->isDone());
        $model->setTitle($task->getTitle());

        return $model;
    }
}
