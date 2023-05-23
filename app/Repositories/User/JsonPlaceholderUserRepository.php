<?php declare(strict_types=1);

namespace App\Repositories\User;

use App\Cache;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class JsonPlaceholderUserRepository implements UserRepository
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function show(int $id): ?User
    {
        try
        {
            $userCacheKey = 'user_' . $id;
            $articleCacheKey = 'user_' . $id . '_articles';
            if (Cache::has($userCacheKey))
            {
                $userInfoResponse = Cache::get($userCacheKey);
                $userArticlesResponse = Cache::get($articleCacheKey);
            }
            else
            {
                $userInfoRequest = $this->client->request
                ('GET', "https://jsonplaceholder.typicode.com/users/{$id}");
                $userInfoResponse = $userInfoRequest->getBody()->getContents();
                Cache::remember($userCacheKey, $userInfoResponse);

                $userArticlesRequest = $this->client->request
                ('GET', "https://jsonplaceholder.typicode.com/users/{$id}/posts");
                $userArticlesResponse = $userArticlesRequest->getBody()->getContents();
                Cache::remember($articleCacheKey, $userArticlesResponse);
            }
            return $this->createModel(json_decode($userInfoResponse), json_decode($userArticlesResponse));
        }
        catch (GuzzleException $exception)
        {
            return null;
        }
    }
    private function createModel(\stdClass $user, array $userArticles): User
    {
        return new User
        (
            $user->id,
            $user->name,
            $user->username,
            $user->email,
            $userArticles
        );
    }
}