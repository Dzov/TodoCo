<?php

namespace App\Controller\Home;

use App\UseCase\Dashboard\GetDashboardWithUserInformation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ShowDashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index(
        UserInterface $user,
        GetDashboardWithUserInformation $getDashboardUseCase
    ) {
        list($tasksInProgress, $tasksStarred, $metrics) = $this->getDashboardUserInformation(
            $user,
            $getDashboardUseCase
        );

        return $this->render(
            'home/homepage.html.twig',
            ['tasksInProgress' => $tasksInProgress, 'starredTasks' => $tasksStarred, 'metrics' => $metrics]
        );
    }

    private function getDashboardUserInformation(UserInterface $user, GetDashboardWithUserInformation $useCase): array
    {
        return $useCase->execute($user->getId());
    }
}
