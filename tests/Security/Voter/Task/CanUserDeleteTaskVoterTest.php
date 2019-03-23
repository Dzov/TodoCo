<?php

namespace App\Tests\Security\Voter\Task;

use App\Entity\Task\TaskAction;
use App\Security\Voter\Task\CanUserDeleteTaskVoter;
use App\Tests\Doubles\Entity\Task\TaskStub1;
use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Repository\Task\InMemoryTaskRepository;
use App\Tests\Doubles\Security\Token\InvalidTokenStub1;
use App\Tests\Doubles\Security\Token\TokenStub1;
use App\Tests\Doubles\Security\VoterService\Task\CanUserDeleteTaskVoterServiceMock;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class CanUserDeleteTaskVoterTest extends TestCase
{
    const WRONG_ATTRIBUTE = 'wrong-attribute';

    const WRONG_SUBJECT   = 'wrong-subject';

    /**
     * @var CanUserDeleteTaskVoter
     */
    private $voter;

    /**
     * @test
     */
    public function wrongAttributeShouldReturnAccessAbstain()
    {
        $vote = $this->voter->vote(new TokenStub1(new UserStub1()), TaskStub1::ID, [self::WRONG_ATTRIBUTE]);

        $this->assertSame(VoterInterface::ACCESS_ABSTAIN, $vote);
    }

    /**
     * @test
     */
    public function subjectIsNotIntShouldReturnAccessDenied()
    {
        $vote = $this->voter->vote(
            new TokenStub1(new UserStub1()),
            self::WRONG_SUBJECT,
            [TaskAction::CAN_USER_DELETE_TASK]
        );

        $this->assertSame(VoterInterface::ACCESS_ABSTAIN, $vote);
    }

    /**
     * @test
     */
    public function userIsTaskAuthorShouldReturnGranted()
    {
        CanUserDeleteTaskVoterServiceMock::$canUserDeleteTask = true;
        $vote = $this->voter->vote(new TokenStub1(new UserStub1()), TaskStub1::ID, [TaskAction::CAN_USER_DELETE_TASK]);

        $this->assertSame(VoterInterface::ACCESS_GRANTED, $vote);
    }

    /**
     * @test
     */
    public function isNotInstanceOfUserShouldReturnAccessDenied()
    {
        $vote = $this->voter->vote(
            new InvalidTokenStub1(),
            TaskStub1::ID,
            [TaskAction::CAN_USER_DELETE_TASK]
        );

        $this->assertSame(VoterInterface::ACCESS_DENIED, $vote);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->voter = new CanUserDeleteTaskVoter(
            new CanUserDeleteTaskVoterServiceMock(new InMemoryTaskRepository([]))
        );
    }
}
