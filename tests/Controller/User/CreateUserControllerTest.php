<?php

namespace App\Tests\Controller\User;

use App\Entity\User\User;
use App\Tests\Controller\AbstractControllerTestCase;
use App\Tests\Doubles\Entity\User\UserStub1;
use Symfony\Component\DomCrawler\Crawler;

class CreateUserControllerTest extends AbstractControllerTestCase
{
    const H1                    = 'Créer un utilisateur';

    const INVALID_EMAIL_ERROR   = 'Cet email est déjà utilisé';

    const SUCCESS_FLASH_MESSAGE = 'L\'utilisateur a bien été ajouté.';

    /**
     * @test
     */
    public function createUser()
    {
        $this->basicLoginAsAdmin();
        $crawler = $this->client->request('GET', 'admin/users/create');

        $this->assertContains(self::H1, $crawler->html());

        $this->submitForm($crawler, self::NEW_USERNAME, self::PASSWORD, self::NEW_EMAIL);
        $crawler = $this->client->followRedirect();

        $this->assertContains(self::SUCCESS_FLASH_MESSAGE, $crawler->html());
        $this->assertNotNull(
            $this->entityManager->getRepository(User::class)->findByEmail(self::NEW_EMAIL)
        );
    }

    protected function submitForm(Crawler $crawler, string $username, string $password, string $email): Crawler
    {
        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]']->setValue($username);
        $form['user[password][first]']->setValue($password);
        $form['user[password][second]']->setValue($password);
        $form['user[email]']->setValue($email);

        return $this->client->submit($form);
    }

    /**
     * @test
     */
    public function createUserWithAlreadyExistingEmailShouldReturnError()
    {
        $this->basicLoginAsAdmin();
        $crawler = $this->client->request('GET', 'admin/users/create');

        $crawler = $this->submitForm($crawler, self::NEW_USERNAME, self::PASSWORD, UserStub1::EMAIL);

        $this->assertContains(self::INVALID_EMAIL_ERROR, $crawler->html());
    }
}
