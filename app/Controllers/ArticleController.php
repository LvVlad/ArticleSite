<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Exceptions\IdNotFoundException;
use App\Services\Article\IndexArticleService;
use App\Services\Article\Show\ShowArticleRequest;
use App\Services\Article\Show\ShowArticleService;

class ArticleController
{
    private IndexArticleService $indexArticleService;
    private ShowArticleService $showArticleService;

    public function __construct
    (
        IndexArticleService $indexArticleService,
        ShowArticleService $showArticleService
    )
    {
        $this->indexArticleService = $indexArticleService;
        $this->showArticleService = $showArticleService;
    }

    public function index(): View
    {
        $articles = $this->indexArticleService->execute();

        return new View('articles', ['articles' => $articles]);
    }

    public function show(array $variables): ?View
    {
        try
        {
            $articleId = $variables['id'] ?? null;
            $response = $this->showArticleService->execute(new ShowArticleRequest((int)$articleId));
        }
        catch (IdNotFoundException $exception)
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