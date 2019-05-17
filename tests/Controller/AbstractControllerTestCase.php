<?php

namespace App\Tests\Controller;

use App\DataFixtures\TaskFixtures;
use App\DataFixtures\UserFixtures;
use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Entity\User\UserStub2;
use Doctrine\ORM\EntityManager;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
abstract class AbstractControllerTestCase extends WebTestCase
{
    const USER_CREDENTIALS  = [
        'username' => UserStub2::USERNAME,
        'password' => UserStub2::PASSWORD,
    ];

    const ADMIN_CREDENTIALS = [
        'username' => UserStub1::USERNAME,
        'password' => UserStub1::PASSWORD,
    ];

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Application
     */
    protected static $application;

    /**
     * @var ContainerInterface
     */
    protected static $container;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    protected function assertSuccessfulResponse(int $expectedStatus = Response::HTTP_OK): void
    {
        $this->assertSame($expectedStatus, $this->client->getResponse()->getStatusCode());
    }

    protected function basicLoginAsAdmin()
    {
        $this->client = self::createClient(
            [],
            [
                'PHP_AUTH_USER' => self::ADMIN_CREDENTIALS['username'],
                'PHP_AUTH_PW'   => self::ADMIN_CREDENTIALS['password'],
            ]
        );
    }

    protected function basicLoginAsUser()
    {
        $this->client = self::createClient(
            [],
            [
                'PHP_AUTH_USER' => self::USER_CREDENTIALS['username'],
                'PHP_AUTH_PW'   => self::USER_CREDENTIALS['password'],
            ]
        );
    }

    protected function setUp()
    {
        $this->client = self::createClient();
        $this->entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');

        $this->loadFixtures([TaskFixtures::class, UserFixtures::class]);
    }
}
