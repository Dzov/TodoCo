<?php

namespace AppBundle\Controller\Task;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class DeleteTaskController extends Controller
{
    public function deleteAction(Task $task)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        $this->addFlash('success', 'La tâche a bien été supprimée.');

        return $this->redirectToRoute('task_list');
    }
}
