<?php

namespace App\Model\Task;

use Symfony\Component\Validator\Constraints as Assert;

class TaskModel
{
    /**
     * @var int
     */
    public $authorId;

    /**
     * @var string
     * @Assert\NotBlank(message="Vous devez saisir du contenu.")
     */
    public $content;

    /**
     * @var \DateTimeImmutable
     */
    public $createdAt;

    /**
     * @var int
     */
    public $id;

    /**
     * @var bool
     */
    public $isDone;

    /**
     * @var string
     * @Assert\NotBlank(message="Vous devez saisir un titre.")
     * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Le titre doit contenir 2 caractères minimum",
     *      maxMessage = "Le titre doit contenir 40 caractères maximum"
     * )
     */
    public $title;

    public function __construct(int $userId)
    {
        $this->authorId = $userId;
        $this->createdAt = new \DateTimeImmutable();
        $this->isDone = false;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setIsDone(bool $isDone)
    {
        $this->isDone = $isDone;
    }

    public function isDone(): bool
    {
        return $this->isDone;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
