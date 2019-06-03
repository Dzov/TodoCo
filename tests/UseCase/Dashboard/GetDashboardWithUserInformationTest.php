<?php

namespace App\Tests\UseCase\Dashboard;

use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Entity\Task\TaskStub2;
use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\UseCase\Task\GetTasksMock;
use App\Tests\UseCase\Task\AssertTaskTrait;
use App\UseCase\Dashboard\GetDashboardWithUserInformation;
use PHPUnit\Framework\TestCase;

class GetDashboardWithUserInformationTest extends TestCase
{
    use AssertTaskTrait;

    /**
     * @var GetDashboardWithUserInformation
     */
    private $useCase;

    /**
     * @test
     */
    public function shouldReturnDashboardUserInformation()
    {
        list ($tasksInProgress, $tasksStarred, $metrics) = $this->useCase->execute(UserStub1::ID);

        $this->assertTasks([new TaskStub2()], $tasksInProgress);
        $this->assertTasks([new TaskStub2()], $tasksStarred);
        $this->assertSame(1, $metrics[GetDashboardWithUserInformation::TASKS_IN_PROGRESS]);
        $this->assertSame(2, $metrics[GetDashboardWithUserInformation::TASKS_CREATED]);
        $this->assertSame(1, $metrics[GetDashboardWithUserInformation::TASKS_CLOSED]);
    }

    protected function setUp()
    {
        $this->useCase = new GetDashboardWithUserInformation(
            new GetTasksMock([TaskStub1::ID => new TaskStub1(), TaskStub2::ID => new TaskStub2()])
        );
    }
}
