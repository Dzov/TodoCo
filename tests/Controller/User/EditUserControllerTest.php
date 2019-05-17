<?php

namespace App\Tests\Controller\User;

use App\Entity\User\User;
use App\Tests\Controller\AbstractControllerTestCase;
use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Entity\User\UserStub2;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;

class EditUserControllerTest extends AbstractControllerTestCase
{
    const INVALID_EMAIL_ERROR   = 'Cet email est déjà utilisé';

    const H1                    = 'Modifier <strong>' . UserStub2::USERNAME . '</strong>';

    const NEW_EMAIL             = 'new-email@test.com';

    const SUCCESS_FLASH_MESSAGE = 'L\'utilisateur a bien été modifié';

    /**
     * @test
     */
    public function editUser()
    {
        $this->loginAsAdmin();
        $crawler = $this->client->request('GET', 'admin/users/' . UserStub2::ID . '/edit');

        $this->assertContains(self::H1, $crawler->html());

        $this->submitForm($crawler, self::NEW_EMAIL);

        $crawler = $this->client->followRedirect();

        $this->assertContains(self::SUCCESS_FLASH_MESSAGE, $crawler->html());
        $user = $this->entityManager->getRepository(User::class)->findById(UserStub2::ID);
        $this->assertSame(self::NEW_EMAIL, $user->getEmail());
    }

    /**
     * @test
     */
    public function editNonExistingUserShouldThrowNotFoundException()
    {
        $this->loginAsAdmin();
        $this->client->request('GET', 'admin/users/454/edit');

        $this->assertSuccessfulResponse(Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     */
    public function editUserWithExistingEmailShouldReturnError()
    {
        $this->loginAsAdmin();
        $crawler = $this->client->request('GET', 'admin/users/' . UserStub2::ID . '/edit');

        $crawler = $this->submitForm($crawler, UserStub1::EMAIL);

        $this->assertContains(self::INVALID_EMAIL_ERROR, $crawler->html());
    }

    protected function submitForm(Crawler $crawler, string $email): Crawler
    {
        $form = $crawler->selectButton('Modifier')->form();
        $form['user[username]']->setValue(UserStub2::USERNAME);
        $form['user[password][first]']->setValue(UserStub2::PASSWORD);
        $form['user[password][second]']->setValue(UserStub2::PASSWORD);
        $form['user[email]']->setValue($email);

        return $this->client->submit($form);
    }
}
