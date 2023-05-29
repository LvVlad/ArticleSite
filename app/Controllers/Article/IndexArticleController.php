<?php declare(strict_types=1);

namespace app\Controllers\Article;

use App\Core\View;
use App\Services\Article\IndexArticleService;

class IndexArticleController
{
    private IndexArticleService $indexArticleService;

    public function __construct
    (
        IndexArticleService $indexArticleService
    )
    {
        $this->indexArticleService = $indexArticleService;
    }

    public function index(): View
    {
        $articles = $this->indexArticleService->execute();

        return new View('articles', ['articles' => $articles]);
    }
}