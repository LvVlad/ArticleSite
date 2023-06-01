<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\Core\View;
use App\Services\Article\Index\IndexArticleService;

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