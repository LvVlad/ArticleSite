<?php declare(strict_types=1);

namespace App\Controllers;

use App\ApiClient;

class PostController
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function
}