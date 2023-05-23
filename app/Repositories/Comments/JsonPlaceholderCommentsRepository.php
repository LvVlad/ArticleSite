<?php declare(strict_types=1);

namespace App\Repositories\Comments;

use App\Cache;
use App\Models\Comment;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class JsonPlaceholderCommentsRepository implements CommentsRepository
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index(int $postId): array
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
                $articleComments[] = $this->createModel($comment);
            }
            return $articleComments;
        }
        catch (GuzzleException $exception)
        {
            return ['not','a','comment'];
        }
    }

    private function createModel(\stdClass $comment): Comment
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