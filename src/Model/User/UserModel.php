<?php

namespace App\Model\User;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UserModel
{
    /**
     * @var string
     * @Assert\NotBlank(message="Vous devez saisir une adresse email.")
     * @Assert\Email(message="Le format de l'adresse n'est pas correcte.")
     */
    protected $email;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     * @Assert\NotBlank(message="Vous devez saisir un nom d'utilisateur.")
     */
    protected $username;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }
}
