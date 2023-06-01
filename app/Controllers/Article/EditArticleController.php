<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\Core\View;
use App\Services\Article\Show\ShowArticleRequest;

class EditArticleController
{
    public function __construct()
    {
    }


    public function openEdit(array $variables)
    {
        $articleId = (int)$variables['id'];
        $response = $this->showArticleService->execute(new ShowArticleRequest($articleId));

        return new View('create', ['article'=>$response->getArticle()]);
    }
}