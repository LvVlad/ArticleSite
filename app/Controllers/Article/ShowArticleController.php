<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\Core\View;
use App\Exceptions\IdNotFoundException;
use App\Services\Article\Show\ShowArticleRequest;
use App\Services\Article\Show\ShowArticleService;

class ShowArticleController
{
    private ShowArticleService $showArticleService;

    public function __construct
    (
        ShowArticleService $showArticleService
    )
    {
        $this->showArticleService = $showArticleService;
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
            //todo add notFound or error View
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
