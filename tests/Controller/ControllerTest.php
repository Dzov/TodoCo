<?php

namespace App\Tests\Controller;

use App\Tests\Doubles\Entity\User\UserStub1;
use App\Tests\Doubles\Entity\User\UserStub2;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ControllerTest extends AbstractControllerTestCase
{
    const EDIT_USER       = ['GET', '/admin/users/' . UserStub1::ID . '/edit'];

    const CREATE_USER     = ['GET', '/admin/users/create'];

    const LIST_USERS      = ['GET', '/admin/users'];

    const DELETE_TASK     = ['GET', '/tasks/' . UserStub2::ID . '/delete'];

    const TOGGLE_TASK     = ['GET', '/tasks/' . UserStub1::ID . '/toggle'];

    const PRIORITIZE_TASK = ['GET', '/tasks/' . UserStub1::ID . '/prioritize'];

    const EDIT_TASK       = ['GET', '/tasks/' . UserStub1::ID . '/edit'];

    const CREATE_TASK     = ['GET', '/tasks/create'];

    const LIST_TASKS      = ['GET', '/tasks'];

    const LOGIN           = ['GET', '/login'];

    const HOMEPAGE        = ['GET', '/'];

    public function routesForAdmin()
    {
        $getUsersShouldReturn200 = self::LIST_USERS;
        $createUserShouldReturn200 = self::CREATE_USER;
        $editUserShouldReturn200 = self::EDIT_USER;

        return [
            $getUsersShouldReturn200,
            $createUserShouldReturn200,
            $editUserShouldReturn200,
        ];
    }

    public function routesForUser()
    {
        $getUsersShouldReturn200 = array_merge(self::LIST_USERS, [Response::HTTP_FORBIDDEN]);
        $createUserShouldReturn200 = array_merge(self::CREATE_USER, [Response::HTTP_FORBIDDEN]);
        $editUserShouldReturn200 = array_merge(self::EDIT_USER, [Response::HTTP_FORBIDDEN]);

        return [
            $getUsersShouldReturn200,
            $createUserShouldReturn200,
            $editUserShouldReturn200,
        ];
    }

    public function commonRoutes()
    {
        $homepageShouldReturn200 = self::HOMEPAGE;
        $loginShouldReturn200 = self::LOGIN;
        $getTasksShouldReturn200 = self::LIST_TASKS;
        $createTaskShouldReturn200 = self::CREATE_TASK;
        $editTaskShouldReturn200 = self::EDIT_TASK;
        $prioritizeTaskShouldReturn200 = array_merge(self::PRIORITIZE_TASK, [Response::HTTP_FOUND]);
        $toggleTaskShouldReturn302 = array_merge(self::TOGGLE_TASK, [Response::HTTP_FOUND]);
        $deleteTaskShouldReturn302 = array_merge(self::DELETE_TASK, [Response::HTTP_FOUND]);

        return [
            $homepageShouldReturn200,
            $loginShouldReturn200,
            $getTasksShouldReturn200,
            $createTaskShouldReturn200,
            $editTaskShouldReturn200,
            $prioritizeTaskShouldReturn200,
            $toggleTaskShouldReturn302,
            $deleteTaskShouldReturn302,
        ];
    }

    /**
     * @test
     * @dataProvider routesForAdmin
     */
    public function assertRoutesAsAdmin(
        string $method,
        string $uri,
        int $expectedStatus = Response::HTTP_OK
    ) {
        $this->loginAsAdmin();

        $this->assertRoute($method, $uri, $expectedStatus);
    }

    /**
     * @test
     * @dataProvider commonRoutes
     */
    public function assertCommonRoutes(
        string $method,
        string $uri,
        int $expectedStatus = Response::HTTP_OK
    ) {
        $this->login();

        $this->assertRoute($method, $uri, $expectedStatus);
    }

    /**
     * @test
     * @dataProvider routesForUser
     */
    public function assertRoutesAsUser(
        string $method,
        string $uri,
        int $expectedStatus = Response::HTTP_OK
    ) {
        $this->login();

        $this->assertRoute($method, $uri, $expectedStatus);
    }

    /**
     * @test
     * @dataProvider routes
     */
    public function assertRoutes(
        string $method,
        string $uri,
        int $expectedStatus = Response::HTTP_OK
    ) {
        $this->login();

        $this->assertRoute($method, $uri, $expectedStatus);
    }

    private function assertRoute(string $method, string $uri, int $expectedStatus): void
    {
        $this->client->request($method, $uri);

        $this->assertSuccessfulResponse($expectedStatus);
    }
}
