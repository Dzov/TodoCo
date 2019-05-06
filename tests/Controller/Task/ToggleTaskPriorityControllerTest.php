<?php

namespace App\Tests\Controller\Task;

use App\Tests\Controller\AbstractControllerTestCase;

class ToggleTaskPriorityControllerTest extends AbstractControllerTestCase
{
    /**
     * @test
     */
    public function toggleTaskPriority()
    {
        $this->loginAsAdmin();
        $this->client->request('GET', '/tasks/' . self::TASK_ID . '/prioritize');
        $crawler = $this->client->followRedirect();

        $this->assertSuccessfulResponse();
        $this->assertContains('La tâche a bien été mise à jour', $crawler->html());
    }
}
