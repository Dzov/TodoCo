<?php

namespace App\DataFixtures\App;

use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
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
        $user1->setUsername('dzov');
        $user1->setEmail('dzov@test.com');
        $user1->setPassword($this->encoder->encodePassword($user1, 'test'));
        $user1->setAdmin(true);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('Rafael');
        $user2->setEmail('rafael@test.com');
        $user2->setPassword($this->encoder->encodePassword($user2, 'test'));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('Olivia');
        $user3->setEmail('olivia@test.com');
        $user3->setPassword($this->encoder->encodePassword($user3, 'test'));
        $manager->persist($user3);

        $user4 = new User();
        $user4->setUsername('Ricardo');
        $user4->setEmail('ricardo@test.com');
        $user4->setPassword($this->encoder->encodePassword($user4, 'test'));
        $manager->persist($user4);

        $user5 = new User();
        $user5->setUsername('Gwen');
        $user5->setEmail('gwen@test.com');
        $user5->setPassword($this->encoder->encodePassword($user5, 'test'));
        $manager->persist($user5);

        $user6 = new User();
        $user6->anonymizeUser();
        $user6->setPassword($this->encoder->encodePassword($user6, 'test'));
        $manager->persist($user6);

        $manager->flush();

        $this->addReference('admin', $user1);
        $this->addReference('regUser1', $user2);
        $this->addReference('regUser2', $user3);
        $this->addReference('regUser3', $user4);
        $this->addReference('regUser4', $user5);
        $this->addReference('anon', $user6);
    }

    public static function getGroups(): array
    {
        return ['AppFixtures'];
    }
}
