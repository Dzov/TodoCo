<?php

namespace App\Tests\Controller\Task;

use App\Entity\Task\TaskFilter;
use App\Tests\Controller\AbstractControllerTestCase;

class ListTasksControllerTest extends AbstractControllerTestCase
{
    /**
     * @test
     * @dataProvider listTasksFilters
     */
    public function withCorrectFilterShouldReturnOK(string $filter)
    {
        $this->basicLoginAsUser();

        $this->client->request('GET', '/tasks/' . $filter);

        $this->assertExpectedResponse();
    }

    public function listTasksFilters(): array
    {
        return [
            [TaskFilter::STARRED],
            [TaskFilter::IN_PROGRESS],
            [TaskFilter::COMPLETED],
        ];
    }
}
