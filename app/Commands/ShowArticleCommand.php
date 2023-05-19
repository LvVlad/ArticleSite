<?php declare(strict_types=1);

namespace App\Commands;

use App\Models\Article;
use App\Services\Article\Show\ShowArticleRequest;
use App\Services\Article\Show\ShowArticleService;

class ShowArticleCommand
{
    public function execute(int $articleId): void
    {
        $service = new ShowArticleService();
        $article = $service->execute(new ShowArticleRequest($articleId))->getArticle();
        $this->format($article);
    }

    private function format(Article $article): void
    {
        echo "Title: {$article->getTitle()}".PHP_EOL;
        echo "Content: {$article->getArticleBody()}".PHP_EOL;
    }
}