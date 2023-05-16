<?php declare(strict_types=1);

namespace App\Controllers;

use App\ApiClient;
use App\Core\View;

class PostController
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function articles(): View
    {
        $articles = $this->client->getAllArticles();
        return new View('articles', ['articles' => $articles]);
    }

    public function article(array $variables): View
    {
        $article = $this->client->getArticle((int)implode('',$variables));
        $comments = $this->client->getComments($article->getId());
        return new View('article', ['article' => $article, 'comments' => $comments]);
    }

    public function user(int $id): View
    {
        $user = $this->client->getUser($id);
        return new View('user', ['user' => $user]);
    }
}