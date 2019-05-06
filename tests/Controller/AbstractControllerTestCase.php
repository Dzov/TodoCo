<?php

namespace App\Tests\Controller;

use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Entity\User\UserStub2;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
abstract class AbstractControllerTestCase extends WebTestCase
{
    const ADMIN_PASSWORD = UserStub1::PASSWORD;

    const ADMIN_USERNAME = UserStub1::USERNAME;

    const USER_PASSWORD  = UserStub2::PASSWORD;

    const USER_USERNAME  = UserStub2::USERNAME;

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

        $form['username'] = self::ADMIN_USERNAME;
        $form['password'] = self::ADMIN_PASSWORD;

        $this->client->submit($form);

        return $crawler;
    }

    protected function login(): Crawler
    {
        $crawler = $this->client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form();

        $form['username'] = self::USER_USERNAME;
        $form['password'] = self::USER_PASSWORD;

        $this->client->submit($form);

        return $crawler;
    }

    protected function logout()
    {
        $this->client->request('GET', '/logout');
    }

    protected function setUp()
    {
        self::runCommand('doctrine:database:drop --force');
        self::runCommand('doctrine:database:create');
        self::runCommand('doctrine:schema:create');
        self::runCommand('doctrine:fixtures:load --append --no-interaction');

        $this->client = self::createClient();
        self::$container = $this->client->getContainer();
        $this->entityManager = self::$container->get('doctrine.orm.entity_manager');
    }

    private static function runCommand($command): int
    {
        $command = sprintf('%s --quiet', $command);

        return self::getApplication()->run(new StringInput($command));
    }

    private static function getApplication(): Application
    {
        if (null === self::$application) {
            $client = static::createClient();

            self::$application = new Application($client->getKernel());
            self::$application->setAutoExit(false);
        }

        return self::$application;
    }

    protected function tearDown()
    {
        $this->logout();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
