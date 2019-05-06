<?php

namespace App\DataFixtures;

use App\Entity\Task\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TaskFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $createdAt = new \DateTimeImmutable();

        $task1 = new Task();
        $task1->setAuthor($this->getReference('user1'));
        $task1->setContent('task 1 - content');
        $task1->setCreatedAt($createdAt->add(new \DateInterval('P1DT23H')));
        $task1->setTitle('Task 1 - title');
        $task1->setIsDone(true);
        $task1->setIsPriority(false);
        $manager->persist($task1);

        $task2 = new Task();
        $task2->setAuthor($this->getReference('user2'));
        $task2->setContent('task 2 - content');
        $task2->setCreatedAt($createdAt->add(new \DateInterval('P2DT23H')));
        $task2->setTitle('Task 2 - title');
        $task2->setIsDone(false);
        $task2->setIsPriority(true);
        $manager->persist($task2);

        $task3 = new Task();
        $task3->setAuthor($this->getReference('user3'));
        $task3->setContent('task 3 - content');
        $task3->setCreatedAt($createdAt->add(new \DateInterval('P3DT23H')));
        $task3->setTitle('Task 3 - title');
        $task3->setIsDone(true);
        $task3->setIsPriority(false);
        $manager->persist($task3);

        $task4 = new Task();
        $task4->setAuthor($this->getReference('user4'));
        $task4->setContent('task 4 - content');
        $task4->setCreatedAt($createdAt->add(new \DateInterval('P4DT23H')));
        $task4->setTitle('Task 4 - title');
        $task4->setIsDone(false);
        $task4->setIsPriority(true);
        $manager->persist($task4);

        $task5 = new Task();
        $task5->setAuthor($this->getReference('user5'));
        $task5->setContent('task 5 - content');
        $task5->setCreatedAt($createdAt->add(new \DateInterval('P5DT23H')));
        $task5->setTitle('Task 5 - title');
        $task5->setIsDone(false);
        $task5->setIsPriority(true);
        $manager->persist($task5);

        $task6 = new Task();
        $task6->setAuthor($this->getReference('user6'));
        $task6->setContent('task 6 - content');
        $task6->setCreatedAt($createdAt->add(new \DateInterval('P6DT23H')));
        $task6->setTitle('Task 6 - title');
        $task6->setIsDone(false);
        $task6->setIsPriority(false);
        $manager->persist($task6);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
