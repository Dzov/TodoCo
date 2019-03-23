<?php

namespace App\Security\Voter\Task;

use App\Entity\Task\TaskAction;
use App\Entity\User\User;
use App\Security\VoterService\Task\CanUserDeleteTaskVoterService;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CanUserDeleteTaskVoter extends Voter
{
    /**
     * @var CanUserDeleteTaskVoterService
     */
    private $voterService;

    /**
     * @param CanUserDeleteTaskVoterService $voterService
     */
    public function __construct(CanUserDeleteTaskVoterService $voterService)
    {
        $this->voterService = $voterService;
    }

    protected function supports($attribute, $subject)
    {
        if (!is_int($subject)) {
            return false;
        }

        if (!in_array($attribute, [TaskAction::CAN_USER_DELETE_TASK])) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $taskId, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return $this->voterService->canUserDeleteTask($token->getUser(), $taskId);
    }
}
