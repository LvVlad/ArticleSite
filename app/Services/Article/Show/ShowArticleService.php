<?php declare(strict_types=1);

namespace App\Services\Article\Show;

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Comments\CommentsRepository;
use App\Repositories\User\UserRepository;

class ShowArticleService
{
    private ArticleRepository $articleRepository;
    private UserRepository $userRepository;
    private CommentsRepository $commentsRepository;

    public function __construct
    (
        ArticleRepository $articleRepository,
        UserRepository $userRepository,
        CommentsRepository $commentsRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->userRepository = $userRepository;
        $this->commentsRepository = $commentsRepository;
    }

    public function execute(ShowArticleRequest $request): ShowArticleResponse
    {
        $article = $this->articleRepository->show($request->getArticleId());
        $author = $this->userRepository->show($article->getUserId());
        $comments = $this->commentsRepository->index($article->getId());

        return new ShowArticleResponse($article, $author, $comments);
    }
}