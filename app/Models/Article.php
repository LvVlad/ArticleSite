<?php declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;

class Article
{
    private int $userId;
    private int $id;
    private string $title;
    private string $articleBody;
    private string $image;
    private string $createdAt;

    public function __construct
    (
        int $userId,
        int $id,
        string $title,
        string $articleBody,
        string $image,
        string $createdAt = null
    )
    {
        $this->userId = $userId;
        $this->id = $id;
        $this->title = $title;
        $this->articleBody = $articleBody;
        $this->image = $image;
        $this->createdAt = $createdAt ?? Carbon::now()->format("d-l H:i");
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getArticleBody(): string
    {
        return $this->articleBody;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}