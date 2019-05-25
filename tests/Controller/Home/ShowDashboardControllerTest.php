<?php

namespace App\Tests\Controller\Home;

use App\Tests\Controller\AbstractControllerTestCase;
use Symfony\Component\HttpFoundation\Response;

class ShowDashboardControllerTest extends AbstractControllerTestCase
{
    /**
     * @test
     */
    public function notConnectedShouldRedirectToLogin()
    {
        $this->client->request('GET', '/');

        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->assertTrue($this->client->getResponse()->isRedirect('/login'));
    }

    /**
     * @test
     */
    public function connectedShouldReturnHomepage()
    {
        $this->basicLoginAsAdmin();

        $this->client->request('GET', '/');

        $this->assertExpectedResponse();
    }
}
