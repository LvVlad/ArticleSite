<?php declare(strict_types=1);

namespace App\Services\Article\Show;

use App\Models\Article;
use App\Models\User;

class ShowArticleResponse
{
    private Article $article;
    private User $author;
    private array $comments;

    public function __construct
    (
        Article $article,
        User $author,
        array $comments
    )
    {
        $this->article = $article;
        $this->author = $author;
        $this->comments = $comments;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getComments(): array
    {
        return $this->comments;
    }


}