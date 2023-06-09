<?php declare(strict_types=1);

namespace App\Commands;

use App\Models\Article;
use App\Models\User;
use App\Services\User\Show\ShowUserRequest;
use App\Services\User\Show\ShowUserService;

class ShowUserCommand
{
    private ShowUserService $showUserService;

    public function __construct(ShowUserService $showUserService)
    {
        $this->showUserService = $showUserService;
    }

    public function execute(int $articleId): void
    {
        $user = $this->showUserService->execute(new ShowUserRequest($articleId))->getUser();
        $this->format($user);
    }

    private function format(User $user): void
    {
        echo "Name: {$user->getName()}".PHP_EOL;
        echo "Email: {$user->getEmail()}".PHP_EOL;
        echo "Posted articles: ".PHP_EOL;
        /** @var Article $article */
        foreach ($user->getArticles() as $article)
        {
            echo '-'.$article->getTitle().PHP_EOL;
        }
    }
}
