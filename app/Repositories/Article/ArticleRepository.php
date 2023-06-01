<?php declare(strict_types=1);

namespace App\Repositories\Article;

use App\Models\Article;

interface ArticleRepository
{
    public function index(): array;
    public function show(int $articleId): ?Article;
}