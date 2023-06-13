<?php declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;

class Article
{
    private int $userId;
    private string $title;
    private string $articleBody;
    private string $image;
    private ?string $createdAt;
    private ?int $id;

    public function __construct
    (
        int $userId,
        string $title,
        string $articleBody,
        string $image = 'https://placehold.co/600x400/green/white/?text=NEW',
        ?string $createdAt = null,
        ?int $id = null
    )
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->articleBody = $articleBody;
        $this->image = $image;
        $this->createdAt = $createdAt ?? Carbon::now()->format("d-l H:i");
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
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

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSnippet(): string
    {
        $array = explode(' ', $this->articleBody);
        $snippet = implode(' ', $array);
        return $snippet.'...';
    }
}