<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ControllerTestCase extends AbstractControllerTestCase
{
    public function routes()
    {
        $homepageShouldReturn200 = ['GET', '/'];
        $loginShouldReturn200 = ['GET', '/login'];
        $getTasksShouldReturn200 = ['GET', '/tasks'];
        $createTaskShouldReturn200 = ['GET', '/tasks/create'];
        $editTaskShouldReturn200 = ['GET', '/tasks/' . self::TASK_ID . '/edit'];
        $prioritizeTaskShouldReturn200 = ['GET', '/tasks/' . self::TASK_ID . '/prioritize', Response::HTTP_FOUND];
        $toggleTaskShouldReturn302 = ['GET', '/tasks/' . self::TASK_ID . '/toggle', Response::HTTP_FOUND];
        $deleteTaskShouldReturn403 = ['GET', '/tasks/' . self::TASK_ID . '/delete', Response::HTTP_FORBIDDEN];
        $getUsersShouldReturn200 = ['GET', '/admin/users'];
        $createUserShouldReturn200 = ['GET', '/admin/users/create'];
        $editUserShouldReturn200 = ['GET', '/admin/users/' . self::USER_ID . '/edit'];

        return [
            $homepageShouldReturn200,
            $loginShouldReturn200,
            $getTasksShouldReturn200,
            $createTaskShouldReturn200,
            $editTaskShouldReturn200,
            $prioritizeTaskShouldReturn200,
            $toggleTaskShouldReturn302,
            $deleteTaskShouldReturn403,
            $getUsersShouldReturn200,
            $createUserShouldReturn200,
            $editUserShouldReturn200,
        ];
    }

    /**
     * @test
     * @dataProvider routes
     */
    public function loggedInShouldRenderRequestedPage(
        string $method,
        string $uri,
        int $expectedStatus = Response::HTTP_OK
    ) {
        $this->login();

        $this->client->request($method, $uri);

        $this->assertSuccessfulResponse($expectedStatus);
    }
}
