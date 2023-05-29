<?php declare(strict_types=1);

namespace App\Commands;

use App\Models\Article;
use App\Services\Article\IndexArticleService;

class IndexArticleCommand
{
    private IndexArticleService $indexArticleService;

    public function __construct
    (
        IndexArticleService $indexArticleService,
    )
    {
        $this->indexArticleService = $indexArticleService;
    }

    public function execute(): void
    {
        $articles = $this->indexArticleService->execute();
        $this->format($articles);
    }

    private function format(array $articles): void
    {
        foreach ($articles as $article)
        {
            /** @var Article $article $ */
            echo "Title: {$article->getTitle()}".PHP_EOL;
            echo "Content: {$article->getArticleBody()}".PHP_EOL;
        }
    }
}