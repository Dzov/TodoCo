<?php

namespace App\DataFixtures\App;

use App\Entity\Task\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TaskFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['AppFixtures'];
    }

    public function load(ObjectManager $manager)
    {
        $createdAt = new \DateTimeImmutable();

        $task1 = new Task();
        $task1->setAuthor($this->getReference('admin'));
        $task1->setContent('Add user task information on dashboard. Handle responsive');
        $task1->setCreatedAt($createdAt->add(new \DateInterval('P1DT23H')));
        $task1->setTitle('Implement dashboard');
        $task1->setIsDone(true);
        $task1->setIsPriority(false);
        $manager->persist($task1);

        $task2 = new Task();
        $task2->setAuthor($this->getReference('regUser1'));
        $task2->setContent('Write buisiness model');
        $task2->setCreatedAt($createdAt->add(new \DateInterval('P2DT23H')));
        $task2->setTitle('Business model');
        $task2->setIsDone(false);
        $task2->setIsPriority(true);
        $manager->persist($task2);

        $task3 = new Task();
        $task3->setAuthor($this->getReference('regUser1'));
        $task3->setContent('Clean backlog, prioritize tasks, remove won\'t dos');
        $task3->setCreatedAt($createdAt->add(new \DateInterval('P3DT23H')));
        $task3->setTitle('Backlog refinement');
        $task3->setIsDone(true);
        $task3->setIsPriority(false);
        $manager->persist($task3);

        $task4 = new Task();
        $task4->setAuthor($this->getReference('regUser2'));
        $task4->setContent('Create FAQ, organize articles');
        $task4->setCreatedAt($createdAt->add(new \DateInterval('P4DT23H')));
        $task4->setTitle('FAQ');
        $task4->setIsDone(false);
        $task4->setIsPriority(true);
        $manager->persist($task4);

        $task5 = new Task();
        $task5->setAuthor($this->getReference('anon'));
        $task5->setContent('Improve code coverage, reach 100% on use cases');
        $task5->setCreatedAt($createdAt->add(new \DateInterval('P5DT23H')));
        $task5->setTitle('Improve coverage');
        $task5->setIsDone(false);
        $task5->setIsPriority(false);
        $manager->persist($task5);

        $task6 = new Task();
        $task6->setAuthor($this->getReference('admin'));
        $task6->setContent('Close at least 5 support requests');
        $task6->setCreatedAt($createdAt->add(new \DateInterval('P6DT23H')));
        $task6->setTitle('Support requests');
        $task6->setIsDone(false);
        $task6->setIsPriority(true);
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
