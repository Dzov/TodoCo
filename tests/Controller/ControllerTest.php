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

    const DELETE_TASK     = ['GET', '/tasks/' . UserStub2::ID . '/delete', Response::HTTP_FOUND];

    const TOGGLE_TASK     = ['GET', '/tasks/' . UserStub1::ID . '/toggle', Response::HTTP_FOUND];

    const PRIORITIZE_TASK = ['GET', '/tasks/' . UserStub1::ID . '/prioritize', Response::HTTP_FOUND];

    const EDIT_TASK       = ['GET', '/tasks/' . UserStub1::ID . '/edit'];

    const CREATE_TASK     = ['GET', '/tasks/create'];

    const LIST_TASKS      = ['GET', '/tasks'];

    const LOGIN           = ['GET', '/login'];

    const HOMEPAGE        = ['GET', '/'];

    const IS_ADMIN        = true;

    public function routeTestCases()
    {
        $allUsersOnHomepageShouldReturnOk = self::HOMEPAGE;
        $allUsersOnLoginShouldReturnOk = self::LOGIN;
        $allUsersOnGetTasksShouldReturnOk = self::LIST_TASKS;
        $allUsersOnCreateTaskShouldReturnOk = self::CREATE_TASK;
        $allUsersOnEditTaskShouldReturnOk = self::EDIT_TASK;
        $allUsersOnPrioritizeTaskShouldRedirect = self::PRIORITIZE_TASK;
        $allUsersOnToggleTaskShouldRedirect = self::TOGGLE_TASK;
        $allUsersOnDeleteTaskShouldRedirect = self::DELETE_TASK;

        $adminOnGetUsersShouldReturnOk = array_merge(self::LIST_USERS, [Response::HTTP_OK, self::IS_ADMIN]);
        $adminOnCreateUserShouldReturnOk = array_merge(self::CREATE_USER, [Response::HTTP_OK, self::IS_ADMIN]);
        $adminOnEditUserShouldReturnOk = array_merge(self::EDIT_USER, [Response::HTTP_OK, self::IS_ADMIN]);

        $userOnGetUsersShouldReturnForbidden = array_merge(self::LIST_USERS, [Response::HTTP_FORBIDDEN]);
        $userOnCreateUserShouldReturnForbidden = array_merge(self::CREATE_USER, [Response::HTTP_FORBIDDEN]);
        $userOnEditUserShouldReturnForbidden = array_merge(self::EDIT_USER, [Response::HTTP_FORBIDDEN]);

        return [
            $allUsersOnHomepageShouldReturnOk,
            $allUsersOnLoginShouldReturnOk,
            $allUsersOnGetTasksShouldReturnOk,
            $allUsersOnCreateTaskShouldReturnOk,
            $allUsersOnEditTaskShouldReturnOk,
            $allUsersOnPrioritizeTaskShouldRedirect,
            $allUsersOnToggleTaskShouldRedirect,
            $allUsersOnDeleteTaskShouldRedirect,
            $adminOnGetUsersShouldReturnOk,
            $adminOnCreateUserShouldReturnOk,
            $adminOnEditUserShouldReturnOk,
            $userOnGetUsersShouldReturnForbidden,
            $userOnCreateUserShouldReturnForbidden,
            $userOnEditUserShouldReturnForbidden,
        ];
    }

    /**
     * @test
     * @dataProvider routeTestCases
     */
    public function assertRoutes(
        string $method,
        string $uri,
        int $expectedStatus = Response::HTTP_OK,
        bool $isAdmin = false
    ) {
        $isAdmin ? $this->basicLoginAsAdmin() : $this->basicLoginAsUser();

        $this->assertRoute($method, $uri, $expectedStatus);
    }

    private function assertRoute(string $method, string $uri, int $expectedStatus): void
    {
        $this->client->request($method, $uri);

        $this->assertSuccessfulResponse($expectedStatus);
    }
}
