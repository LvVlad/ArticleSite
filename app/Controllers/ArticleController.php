<?php declare(strict_types=1);

namespace App\Controllers;

use App\ApiClient;
use App\Core\View;
use App\Services\Article\IndexArticleService;
use App\Services\Article\Show\ShowArticleRequest;
use App\Services\Article\Show\ShowArticleService;
use http\Exception\RuntimeException;

class ArticleController
{
    public function index(): View
    {
        $service = new IndexArticleService();
        $articles = $service->execute();

        return new View('articles', ['articles' => $articles]);
    }

    public function show(array $variables): ?View
    {
        try
        {
            $articleId = $variables['id'] ?? null;
            $service = new ShowArticleService();
            $response = $service->execute(new ShowArticleRequest((int)$articleId));
        }
        catch (RuntimeException $exception)
        {
            return null;
        }

        return new View
        ('article',
            [
                'article' => $response->getArticle(),
                'comments' => $response->getComments(),
                'author' => $response->getAuthor()
            ]
        );
    }
}