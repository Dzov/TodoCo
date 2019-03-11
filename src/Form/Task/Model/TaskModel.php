<?php

namespace App\Form\Task\Model;

use Symfony\Component\Validator\Constraints as Assert;

class TaskModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Vous devez saisir un titre.")
     */
    protected $title;

    /**
     * @var string
     * @Assert\NotBlank(message="Vous devez saisir du contenu.")
     */
    protected $content;

    /**
     * @var \Datetime
     */
    protected $createdAt;

    /**
     * @var bool
     */
    protected $isDone;

    public function __construct()
    {
        $this->createdAt = new \Datetime();
        $this->isDone = false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return \Datetime
     */
    public function getCreatedAt(): \Datetime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\Datetime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function isDone(): bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone)
    {
        $this->isDone = $isDone;
    }
}
