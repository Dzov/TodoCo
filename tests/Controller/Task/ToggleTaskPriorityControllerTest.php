<?php

namespace App\Tests\Controller\Task;

use App\Tests\Controller\AbstractControllerTestCase;
use App\Tests\Doubles\Entity\Task\TaskStub1;

class ToggleTaskPriorityControllerTest extends AbstractControllerTestCase
{
    /**
     * @test
     */
    public function toggleTaskPriority()
    {
        $this->loginAsAdmin();
        $this->client->request('GET', '/tasks/' . TaskStub1::ID . '/prioritize');
        $crawler = $this->client->followRedirect();

        $this->assertSuccessfulResponse();
        $this->assertContains('La tâche a bien été mise à jour', $crawler->html());
    }
}
