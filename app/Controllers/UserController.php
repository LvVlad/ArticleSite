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

    public function show(int $id): View
    {
        $user = $this->client->getUser($id);
        return new View('user', ['user' => $user]);
    }
}