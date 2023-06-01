<?php declare(strict_types=1);

namespace App\Controllers\User;

use App\Core\View;
use App\Exceptions\IdNotFoundException;
use App\Services\User\Show\ShowUserRequest;
use App\Services\User\Show\ShowUserService;

class UserController
{
    private ShowUserService $showUserService;

    public function __construct(ShowUserService $showUserService)
    {
        $this->showUserService = $showUserService;
    }

    public function show(array $variables): ?View
    {
        try
        {
            $userId = $variables['id'] ?? null;
            $response = $this->showUserService->execute(new ShowUserRequest((int)$userId));

            return new View('user', ['user' => $response->getUser()]);
        }
        catch (IdNotFoundException $exception)
        {
            return null;
        }
    }
}