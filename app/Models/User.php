<?php declare(strict_types=1);

namespace App\Models;

class User
{
    private int $id;
    private string $name;
    private string $username;
    private string $email;
    private array $articles;

    public function __construct
    (
        int $id,
        string $name,
        string $username,
        string $email,
        array $articles
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->articles = $articles;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getArticles(): array
    {
        $articles= [];
        foreach ($this->articles as $article)
        {
            $articles[] = new Article
            (
                $article->userId,
                $article->title,
                $article->body,
                'https://placehold.co/600x400/green/white/?text=Code',
                null,
                $article->id
            );
        }
        return $articles;
    }
}