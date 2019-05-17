<?php

namespace App\DataFixtures;

use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('UserStub1');
        $user1->setEmail('user1@test.com');
        $user1->setPassword($this->encoder->encodePassword($user1, 'test'));
        $user1->setAdmin(true);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('UserStub2');
        $user2->setEmail('user2@test.com');
        $user2->setPassword($this->encoder->encodePassword($user2, 'test'));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('UserStub3');
        $user3->setEmail('user3@test.com');
        $user3->setPassword($this->encoder->encodePassword($user3, 'test'));
        $manager->persist($user3);

        $user4 = new User();
        $user4->setUsername('UserStub4');
        $user4->setEmail('user4@test.com');
        $user4->setPassword($this->encoder->encodePassword($user4, 'test'));
        $manager->persist($user4);

        $user5 = new User();
        $user5->setUsername('UserStub5');
        $user5->setEmail('user5@test.com');
        $user5->setPassword($this->encoder->encodePassword($user5, 'test'));
        $manager->persist($user5);

        $user6 = new User();
        $user6->setUsername('UserStub6');
        $user6->setEmail('user6@test.com');
        $user6->setPassword($this->encoder->encodePassword($user6, 'test'));
        $manager->persist($user6);

        $manager->flush();

        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
        $this->addReference('user3', $user3);
        $this->addReference('user4', $user4);
        $this->addReference('user5', $user5);
        $this->addReference('user6', $user6);
    }
}
