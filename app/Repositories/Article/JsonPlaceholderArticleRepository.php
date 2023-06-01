<?php declare(strict_types=1);

namespace App\Repositories\Article;

use App\Cache;
use App\Models\Article;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class JsonPlaceholderArticleRepository implements ArticleRepository
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index(): array
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
                $allArticles[] = $this->createModel($article);
            }
            return $allArticles;
        }
        catch (GuzzleException $exception)
        {
            return ['something','went','wrong'];
        }
    }

    public function show(int $articleId): ?Article
    {
        try
        {
            $cacheKey = 'article_' . $articleId;
            if (Cache::has($cacheKey))
            {
                $response = Cache::get($cacheKey);
            }
            else
            {
                $request = $this->client->request
                ('GET', "https://jsonplaceholder.typicode.com/posts/{$articleId}");
                $response = $request->getBody()->getContents();
                Cache::remember($cacheKey, $response);
            }

            return $this->createModel(json_decode($response));
        }
        catch (GuzzleException $exception)
        {
            return null;
        }
    }

    public function store(Article $article): ?Article
    {
        return null;
    }

    public function edit(Article $article): ?Article
    {
        return null;
    }

    private function createModel(\stdClass $article): Article
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
}
