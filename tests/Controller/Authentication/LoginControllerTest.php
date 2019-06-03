<?php

namespace App\Tests\Controller\Authentication;

use App\Tests\Controller\AbstractControllerTestCase;
use Symfony\Component\DomCrawler\Crawler;

class LoginControllerTest extends AbstractControllerTestCase
{
    /**
     * @test
     */
    public function loginAsAdminShouldRedirectToHomeWithAdminAccess()
    {
        $this->loginAsAdmin();
        $crawler = $this->client->followRedirect();

        $this->assertContains('Admin', $crawler->html());
    }

    /**
     * @test
     */
    public function loginAsUserShouldRedirectToHomeWithoutAdminAccess()
    {
        $this->login();
        $crawler = $this->client->followRedirect();

        $this->assertNotContains('Admin', $crawler->html());
    }

    private function loginAsAdmin(): Crawler
    {
        $crawler = $this->client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form();

        $form['username'] = self::ADMIN_CREDENTIALS['username'];
        $form['password'] = self::ADMIN_CREDENTIALS['password'];

        $crawler = $this->client->submit($form);

        return $crawler;
    }

    private function login(): Crawler
    {
        $crawler = $this->client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form();

        $form['username'] = self::USER_CREDENTIALS['username'];
        $form['password'] = self::USER_CREDENTIALS['password'];

        $this->client->submit($form);

        return $crawler;
    }
}
