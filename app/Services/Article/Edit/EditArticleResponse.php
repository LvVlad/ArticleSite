<?php declare(strict_types=1);

namespace App\Services\Article\Edit;

use App\Models\Article;

class EditArticleResponse
{
    private Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }
}