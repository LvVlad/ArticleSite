<?php declare(strict_types=1);

namespace App\Services\Article\Edit;

use App\Repositories\Article\ArticleRepository;

class EditArticleService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(EditArticleRequest $request)
    {
        //get article
        //edit article
        //update db
    }
}