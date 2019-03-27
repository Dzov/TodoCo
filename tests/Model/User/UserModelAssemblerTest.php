<?php

namespace App\Tests\Model\User;

use App\Entity\Security\Roles;
use App\Model\User\UserModelAssembler;
use App\Tests\Doubles\Entity\User\UserStub1;
use PHPUnit\Framework\TestCase;

class UserModelAssemblerTest extends TestCase
{
    /**
     * @var UserModelAssembler
     */
    private $assembler;

    /**
     * @test
     */
    public function createFromEntity()
    {
        $expected = new UserStub1([Roles::ROLE_USER]);
        $actual = $this->assembler->createFromEntity($expected);

        $this->assertSame($expected->getId(), $actual->getId());
        $this->assertSame($expected->getUsername(), $actual->getUsername());
        $this->assertSame($expected->getEmail(), $actual->getEmail());
        $this->assertSame($expected->getPassword(), $actual->getPassword());
        $this->assertSame($expected->isAdmin(), $actual->isAdmin());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->assembler = new UserModelAssembler();
    }
}
