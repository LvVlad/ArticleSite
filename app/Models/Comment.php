<?php declare(strict_types=1);

namespace App\Models;

class Comment
{
    private int $articleId;
    private int $id;
    private string $title;
    private string $email;
    private string $body;

    public function __construct
    (
        int $articleId,
        int $id,
        string $title,
        string $email,
        string $body
    )
    {
        $this->articleId = $articleId;
        $this->id = $id;
        $this->title = $title;
        $this->email = $email;
        $this->body = $body;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCommentBody(): string
    {
        return $this->body;
    }
}
