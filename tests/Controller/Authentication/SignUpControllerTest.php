<?php

namespace App\Tests\Controller\Authentication;

use App\Tests\Controller\AbstractControllerTestCase;
use Symfony\Component\DomCrawler\Crawler;

class SignUpControllerTest extends AbstractControllerTestCase
{
    const SUCCESS_REGISTER_MESSAGE = 'Votre compte a bien été créé.';

    /**
     * @test
     */
    public function signUpShouldCreateUser()
    {
        $crawler = $this->client->request('GET', 'register');
        $this->submitForm($crawler, self::NEW_USERNAME, self::PASSWORD, self::NEW_EMAIL);
        $crawler = $this->client->followRedirect();

        $this->assertContains(self::SUCCESS_REGISTER_MESSAGE, $crawler->html());
    }

    protected function submitForm(Crawler $crawler, string $username, string $password, string $email): Crawler
    {
        $form = $crawler->selectButton('Valider')->form();
        $form['user[username]']->setValue($username);
        $form['user[password][first]']->setValue($password);
        $form['user[password][second]']->setValue($password);
        $form['user[email]']->setValue($email);

        return $this->client->submit($form);
    }
}
