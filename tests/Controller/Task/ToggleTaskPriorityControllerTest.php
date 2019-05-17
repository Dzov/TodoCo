<?php

namespace App\Tests\Controller\Task;

use App\Tests\Controller\AbstractControllerTestCase;
use App\Tests\Doubles\Entity\Task\TaskStub1;
use Symfony\Component\HttpFoundation\Response;

class ToggleTaskPriorityControllerTest extends AbstractControllerTestCase
{
    /**
     * @test
     */
    public function toggleTaskPriority()
    {
        $this->basicLoginAsAdmin();
        $this->client->request('GET', '/tasks/' . TaskStub1::ID . '/prioritize');
        $crawler = $this->client->followRedirect();

        $this->assertSuccessfulResponse();
        $this->assertContains('La tâche a bien été mise à jour', $crawler->html());
    }

    /**
     * @test
     */
    public function toggleNonExistingTaskShouldThrowNotFoundException()
    {
        $this->basicLoginAsUser();
        $this->client->request('GET', '/tasks/6743/prioritize');

        $this->assertSuccessfulResponse(Response::HTTP_NOT_FOUND);
    }
}
