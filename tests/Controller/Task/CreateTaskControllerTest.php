<?php

namespace App\Tests\Controller\Task;

use App\Tests\Controller\AbstractControllerTestCase;

class CreateTaskControllerTest extends AbstractControllerTestCase
{
    const TASK_CONTENT = 'new task content';

    const TASK_TITLE   = 'new task';

    /**
     * @test
     */
    public function createTask()
    {
        $this->login();
        $crawler = $this->client->request('GET', '/tasks/create');

        $this->assertSuccessfulResponse();
        $this->assertContains('Ajouter une tâche', $crawler->html());

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]']->setValue(self::TASK_TITLE);
        $form['task[content]']->setValue(self::TASK_CONTENT);
        $this->client->submit($form);

        $crawler = $this->client->followRedirect();
        $this->assertSuccessfulResponse();
        $this->assertContains('La tâche a bien été ajoutée.', $crawler->html());
        $this->assertContains(self::TASK_TITLE, $crawler->html());
        $this->assertContains(self::TASK_CONTENT, $crawler->html());
    }
}
