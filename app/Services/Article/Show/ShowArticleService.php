<?php declare(strict_types=1);

namespace App\Services\Article\Show;

use App\ApiClient;

class ShowArticleService
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function execute(ShowArticleRequest $request): ShowArticleResponse
    {
        $article = $this->client->getArticle($request->getArticleId());
        $author = $this->client->getUser($article->getUserId());
        $comments = $this->client->getComments($article->getId());

        return new ShowArticleResponse($article, $author, $comments);
    }
}