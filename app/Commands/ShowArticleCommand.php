<?php declare(strict_types=1);

namespace App\Commands;

use App\Models\Article;
use App\Services\Article\Show\ShowArticleRequest;
use App\Services\Article\Show\ShowArticleService;

class ShowArticleCommand
{
    private ShowArticleService $showArticleService;

    public function __construct(ShowArticleService $showArticleService)
    {
        $this->showArticleService = $showArticleService;
    }

    public function execute(int $articleId): void
    {
        $article = $this->showArticleService->execute(new ShowArticleRequest($articleId))->getArticle();
        $this->format($article);
    }

    private function format(Article $article): void
    {
        echo "Title: {$article->getTitle()}".PHP_EOL;
        echo "Content: {$article->getArticleBody()}".PHP_EOL;
    }
}