<?php declare(strict_types=1);

namespace App\Controllers;

use App\ApiClient;
use App\Core\View;

class UserController
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function show(array $variables): View
    {
        $userId = $variables['id'] ?? null;
        $user = $this->client->getUser((int)$userId);
        return new View('user', ['user' => $user]);
    }
}