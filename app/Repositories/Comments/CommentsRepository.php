<?php declare(strict_types=1);

namespace App\Repositories\Comments;

interface CommentsRepository
{
    public function index(int $postId): array;
}