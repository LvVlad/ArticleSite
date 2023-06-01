<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\Core\Redirect\Redirect;
use App\Core\View;
use App\Services\Article\Create\CreateArticleRequest;
use App\Services\Article\Create\CreateArticleService;

class CreateArticleController
{
    private CreateArticleService $createArticleService;

    public function __construct
    (
        CreateArticleService $createArticleService
    )
    {
        $this->createArticleService = $createArticleService;
    }

    public function create(): View
    {
        return new View('create', []);
    }

    public function store(): Redirect
    {
        $title = $_POST['title'];
        $body = $_POST['body'];

        $article = $this->createArticleService->execute(new CreateArticleRequest($title, $body));

        return new Redirect('/article/'.$article->getArticle()->getId());
    }
}