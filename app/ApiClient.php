<?php declare(strict_types=1);

namespace App;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getAllArticles(): array
    {
        try
        {
            $cacheKey = 'articles';
            if (Cache::has($cacheKey))
            {
                $response = Cache::get($cacheKey);
            }
            else
            {
                $request = $this->client->request('GET', 'https://jsonplaceholder.typicode.com/posts');
                $response = $request->getBody()->getContents();
                Cache::remember($cacheKey, $response);
            }

            $allArticles = [];
            foreach (json_decode($response) as $article)
            {
                $allArticles[] = $this->createArticle($article);
            }
            return $allArticles;
        }
        catch (GuzzleException $exception)
        {
            return ['something','went','wrong'];
        }
    }

    public function getComments(int $postId): array
    {
        try
        {
            $cacheKey = 'article_' . $postId . '_comments';
            if (Cache::has($cacheKey))
            {
                $response = Cache::get($cacheKey);
            }
            else
            {
                $request = $this->client->request
                ('GET', "https://jsonplaceholder.typicode.com/posts/{$postId}/comments");
                $response = $request->getBody()->getContents();
                Cache::remember($cacheKey, $response);
            }

            $articleComments = [];
            foreach (json_decode($response) as $comment)
            {
                $articleComments[] = $this->createComment($comment);
            }
            return $articleComments;
        }
        catch (GuzzleException $exception)
        {
            return ['not','a','comment'];
        }
    }

    public function getArticle(int $postId): ?Article
    {
        try
        {
            $cacheKey = 'article_' . $postId;
            if (Cache::has($cacheKey))
            {
                $response = Cache::get($cacheKey);
            }
            else
            {
                $request = $this->client->request
                ('GET', "https://jsonplaceholder.typicode.com/posts/{$postId}");
                $response = $request->getBody()->getContents();
                Cache::remember($cacheKey, $response);
            }

            return $this->createArticle(json_decode($response));
        }
        catch (GuzzleException $exception)
        {
            return null;
        }
    }

    public function getUser(int $id): ?User
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
            return $this->createUser(json_decode($userInfoResponse), json_decode($userArticlesResponse));
        }
        catch (GuzzleException $exception)
        {
            return null;
        }
    }

    private function createArticle(\stdClass $article): Article
    {
        return new Article
        (
            $article->userId,
            $article->id,
            $article->title,
            $article->body,
            'https://placehold.co/600x400/green/white/?text=Code'
        );
    }

    private function createUser(\stdClass $user, array $userArticles): User
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

    private function createComment(\stdClass $comment): Comment
    {
        return new Comment
        (
            $comment->postId,
            $comment->id,
            $comment->name,
            $comment->email,
            $comment->body
        );
    }
}