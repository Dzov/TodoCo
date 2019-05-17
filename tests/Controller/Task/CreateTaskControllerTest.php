<?php

namespace App\Tests\Controller\Task;

use App\Entity\Task\Task;
use App\Tests\Controller\AbstractControllerTestCase;

class CreateTaskControllerTest extends AbstractControllerTestCase
{
    const H1                    = 'Ajouter une tâche';

    const SUCCESS_FLASH_MESSAGE = 'La tâche a bien été ajoutée.';

    const TASK_CONTENT          = 'new task content';

    const TASK_TITLE            = 'new task';

    /**
     * @test
     */
    public function createTask()
    {
        $this->loginAsAdmin();
        $crawler = $this->client->request('GET', '/tasks/create');

        $this->assertContains(self::H1, $crawler->html());

        $form = $crawler->selectButton('Ajouter')->form();
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
}
