<?php

namespace App\Entity\Task;

use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 * @ORM\Table
 */
class Task
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User\User")
     * @JoinColumn(name="author", referencedColumnName="id", nullable=false)
     */
    protected $author;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Vous devez saisir du contenu.")
     */
    protected $content;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isDone;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Vous devez saisir un titre.")
     */
    protected $title;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->isDone = false;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function isDone()
    {
        return $this->isDone;
    }

    public function toggle()
    {
        $this->setIsDone(!$this->isDone);
    }

    public function getIsDone(): bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getAuthorUsername(): string
    {
        return $this->getAuthor()->getUsername();
    }

    public function getAuthorId(): int
    {
        return $this->getAuthor()->getId();
    }
}
