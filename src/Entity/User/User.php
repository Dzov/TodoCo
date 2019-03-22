<?php

namespace App\Entity\User;

use App\Entity\Security\Roles;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table("user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBlank(message="Vous devez saisir une adresse email.")
     * @Assert\Email(message="Le format de l'adresse n'est pas correcte.")
     */
    protected $email;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $password;

    /**
     * @ORM\Column(type="json")
     * @var array
     */
    protected $roles = [];

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    protected $username;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setAdmin(bool $isAdmin)
    {
        $isAdmin ? $this->addRole(Roles::ROLE_ADMIN) : $this->removeRole(Roles::ROLE_ADMIN);
    }

    public function isAdmin(): bool
    {
        return in_array(Roles::ROLE_ADMIN, $this->getRoles());
    }

    public function getRoles(): array
    {
        if (!in_array(Roles::ROLE_USER, $this->roles)) {
            $this->roles[] = Roles::ROLE_USER;
        }

        return array_unique($this->roles);
    }

    private function addRole(string $role)
    {
        if (!in_array($role, $this->getRoles())) {
            $this->roles[] = $role;
        }
    }

    private function removeRole(string $role)
    {
        if (in_array($role, $this->getRoles())) {
            $this->roles = array_diff($this->roles, [$role]);
        }
    }

    public function eraseCredentials()
    {
    }
}
