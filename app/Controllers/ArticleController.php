<?php declare(strict_types=1);

namespace App\Controllers;

use App\ApiClient;
use App\Core\View;

class ArticleController
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function index(): View
    {
        $articles = $this->client->getAllArticles();
        return new View('articles', ['articles' => $articles]);
    }

    public function show(array $variables): View
    {
        $articleId = $variables['id'] ?? null;
        $article = $this->client->getArticle((int)$articleId);
        $comments = $this->client->getComments($article->getId());
        return new View('article', ['article' => $article, 'comments' => $comments]);
    }
}