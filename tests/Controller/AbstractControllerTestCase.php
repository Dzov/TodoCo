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
use Symfony\Component\DomCrawler\Crawler;
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

    protected function loginAsAdmin(): Crawler
    {
        $crawler = $this->client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form();

        $form['username'] = self::ADMIN_CREDENTIALS['username'];
        $form['password'] = self::ADMIN_CREDENTIALS['password'];

        $this->client->submit($form);

        return $crawler;
    }

    protected function login(): Crawler
    {
        $crawler = $this->client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form();

        $form['username'] = self::USER_CREDENTIALS['username'];
        $form['password'] = self::USER_CREDENTIALS['password'];

        $this->client->submit($form);

        return $crawler;
    }

    public function loginHttpBasic()
    {
        $this->client = self::createClient(
            [],
            [
                'PHP_AUTH_USER' => self::ADMIN_CREDENTIALS['username'],
                'PHP_AUTH_PW'   => self::ADMIN_CREDENTIALS['password'],
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
