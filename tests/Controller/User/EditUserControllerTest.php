<?php

namespace App\Tests\Controller\User;

use App\Entity\User\User;
use App\Tests\Controller\AbstractControllerTestCase;
use App\Tests\Doubles\Entity\User\UserStub2;

class EditUserControllerTest extends AbstractControllerTestCase
{
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

        $form = $crawler->selectButton('Modifier')->form();
        $form['user[username]']->setValue(UserStub2::USERNAME);
        $form['user[password][first]']->setValue(UserStub2::PASSWORD);
        $form['user[password][second]']->setValue(UserStub2::PASSWORD);
        $form['user[email]']->setValue(self::NEW_EMAIL);
        $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertContains(self::SUCCESS_FLASH_MESSAGE, $crawler->html());
        $user = $this->entityManager->getRepository(User::class)->findById(UserStub2::ID);
        $this->assertSame(self::NEW_EMAIL, $user->getEmail());
    }
}
