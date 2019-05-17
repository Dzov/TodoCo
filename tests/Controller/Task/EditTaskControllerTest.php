<?php

namespace App\Tests\Controller\Task;

use App\Entity\Task\Task;
use App\Tests\Controller\AbstractControllerTestCase;
use App\Tests\Doubles\Entity\Task\TaskStub1;
use Symfony\Component\HttpFoundation\Response;

class EditTaskControllerTest extends AbstractControllerTestCase
{
    const H1                    = 'Modifier une tâche';

    const SUCCESS_FLASH_MESSAGE = 'La tâche a bien été modifiée.';

    const TASK_CONTENT          = 'new task content';

    const TASK_TITLE            = 'new task';

    /**
     * @test
     */
    public function editTask()
    {
        $this->basicLoginAsUser();
        $crawler = $this->client->request('GET', '/tasks/' . TaskStub1::ID . '/edit');

        $this->assertContains(self::H1, $crawler->html());

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]']->setValue(self::TASK_TITLE);
        $form['task[content]']->setValue(self::TASK_CONTENT);
        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        $this->assertContains(self::SUCCESS_FLASH_MESSAGE, $crawler->html());
        $this->assertContains(self::TASK_TITLE, $crawler->html());
        $this->assertContains(self::TASK_CONTENT, $crawler->html());
        $this->assertNotNull(
            $this->entityManager->getRepository(Task::class)->findOneBy(['title' => self::TASK_TITLE])
        );
    }

    /**
     * @test
     */
    public function editNonExistingTaskShouldThrowNotFoundException()
    {
        $this->basicLoginAsUser();
        $this->client->request('GET', '/tasks/6743/edit');

        $this->assertSuccessfulResponse(Response::HTTP_NOT_FOUND);
    }
}
