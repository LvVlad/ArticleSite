<?php declare(strict_types=1);

namespace App\Repositories\Article;

use App\Models\Article;

interface ArticleRepository
{
    public function index(): array;
    public function show(int $articleId): ?Article;
    public function store(Article $article): ?Article;
    public function edit(Article $article): ?Article;
}