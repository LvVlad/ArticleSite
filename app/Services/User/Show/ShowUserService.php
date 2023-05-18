<?php declare(strict_types=1);

namespace App\Services\User\Show;

use App\ApiClient;

class ShowUserService
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function execute(ShowUserRequest $request): ShowUserResponse
    {
        $user = $this->client->getUser($request->getUserId());
        return new ShowUserResponse($user);
    }
}