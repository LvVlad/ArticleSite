<?php declare(strict_types=1);

namespace App\Commands;

use App\Models\Article;
use App\Services\Article\IndexArticleService;

class IndexArticleCommand
{
    public function execute(): void
    {
        $service = new IndexArticleService();
        $articles = $service->execute();
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