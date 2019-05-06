<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
abstract class AbstractControllerTestCase extends WebTestCase
{
    const ADMIN_PASSWORD = 'test';

    const ADMIN_USERNAME = 'UserStub1';

    const PASSWORD       = 'test';

    const USERNAME       = 'UserStub2';

    const TASK_ID        = 12;

    const USER_ID        = 12;

    /**
     * @var Client
     */
    protected $client;

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

        $form['username'] = self::USERNAME;
        $form['password'] = self::PASSWORD;

        $this->client->submit($form);

        return $crawler;
    }

    protected function setUp()
    {
        $this->client = self::createClient();
    }
}
