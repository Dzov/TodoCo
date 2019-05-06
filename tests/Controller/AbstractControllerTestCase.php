<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
abstract class AbstractControllerTestCase extends WebTestCase
{
    const PASSWORD = 'test';

    const USERNAME = 'UserStub1';

    const TASK_ID  = 12;

    const USER_ID  = 12;

    /**
     * @var Client
     */
    protected $client;

    protected function assertSuccessfulResponse(int $expectedStatus = Response::HTTP_OK)
    {
        $this->assertSame($expectedStatus, $this->client->getResponse()->getStatusCode());
    }

    protected function login(): \Symfony\Component\DomCrawler\Crawler
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
