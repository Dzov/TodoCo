<?php

namespace App\Tests\Controller\Task;

use App\Tests\Controller\AbstractControllerTestCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteTaskControllerTest extends AbstractControllerTestCase
{
    const INVALID_TASK_ID = 7654365432;

    /**
     * @test
     */
    public function deletingNonExistantTaskShouldReturnNotFound()
    {
        $this->basicLoginAsUser();

        $this->client->request('GET', 'tasks/' . self::INVALID_TASK_ID . '/delete');

        $this->assertExpectedResponse(Response::HTTP_NOT_FOUND);
    }
}
