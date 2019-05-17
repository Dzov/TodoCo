<?php

namespace App\Tests\Controller\Task;

use App\Tests\Controller\AbstractControllerTestCase;
use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Entity\Task\TaskStub2;
use Symfony\Component\HttpFoundation\Response;

class ToggleTaskStatusControllerTest extends AbstractControllerTestCase
{
    const SET_TASK_DONE_FLASH_MESSAGE        = 'La tâche ' . TaskStub2::TITLE . ' est terminée !';

    const SET_TASK_IN_PROGRESS_FLASH_MESSAGE = 'La tâche ' . TaskStub1::TITLE . ' a bien été marquée non terminée.';

    /**
     * @test
     */
    public function toggleTaskStatusToDo()
    {
        $this->basicLoginAsAdmin();
        $this->client->request('GET', '/tasks/' . TaskStub1::ID . '/toggle');
        $crawler = $this->client->followRedirect();

        $this->assertContains(self::SET_TASK_IN_PROGRESS_FLASH_MESSAGE, $crawler->html());
    }

    /**
     * @test
     */
    public function toggleTaskStatusDone()
    {
        $this->basicLoginAsUser();
        $this->client->request('GET', '/tasks/' . TaskStub2::ID . '/toggle');
        $crawler = $this->client->followRedirect();

        $this->assertContains(self::SET_TASK_DONE_FLASH_MESSAGE, $crawler->html());
    }

    /**
     * @test
     */
    public function toggleNonExistingTaskShouldThrowNotFoundException()
    {
        $this->basicLoginAsUser();
        $this->client->request('GET', '/tasks/6743/toggle');

        $this->assertSuccessfulResponse(Response::HTTP_NOT_FOUND);
    }
}
