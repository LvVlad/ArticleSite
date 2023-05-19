<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Exceptions\IdNotFoundException;
use App\Services\User\Show\ShowUserRequest;
use App\Services\User\Show\ShowUserService;

class UserController
{

    public function show(array $variables): ?View
    {
        try
        {
            $userId = $variables['id'] ?? null;
            $service = new ShowUserService();
            $response = $service->execute(new ShowUserRequest((int)$userId));

            return new View('user', ['user' => $response->getUser()]);
        }
        catch (IdNotFoundException $exception)
        {
            return null;
        }
    }
}