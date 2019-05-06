<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ControllerTestCase extends AbstractControllerTestCase
{
    const TASK_ID = 12;

    const USER_ID = 12;

    public function routes()
    {
        $homepage = ['GET', '/'];
        $login = ['GET', '/login'];
        $getTasks = ['GET', '/tasks'];
        $createTask = ['GET', '/tasks/create'];
        $editTask = ['GET', '/tasks/' . self::TASK_ID . '/edit'];
        $prioritizeTask = ['GET', '/tasks/' . self::TASK_ID . '/prioritize', Response::HTTP_FOUND];
        $toggleTask = ['GET', '/tasks/' . self::TASK_ID . '/toggle', Response::HTTP_FOUND];
        $deleteTask = ['GET', '/tasks/' . self::TASK_ID . '/delete', Response::HTTP_FORBIDDEN];
        $getUsers = ['GET', '/admin/users'];
        $createUser = ['GET', '/admin/users/create'];
        $editUser = ['GET', '/admin/users/' . self::USER_ID . '/edit'];

        return [
            $homepage,
            $login,
            $getTasks,
            $createTask,
            $editTask,
            $prioritizeTask,
            $toggleTask,
            $deleteTask,
            $getUsers,
            $createUser,
            $editUser,
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
