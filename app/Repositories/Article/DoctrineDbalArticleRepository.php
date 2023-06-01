<?php declare(strict_types=1);

namespace App\Repositories\Article;


use App\Core\Database;
use App\Models\Article;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class DoctrineDbalArticleRepository implements ArticleRepository
{
    private Connection $connection;
    private QueryBuilder $builder;

    public function __construct()
    {
        $this->connection = (new Database())->getDatabaseConnection();
        $this->builder = $this->connection->createQueryBuilder();
    }

    public function index(): array
    {
        $articles = $this->builder
            ->select('*')
            ->from('articles')
            ->fetchAllAssociative();

        $allArticles = [];
        foreach ($articles as $article)
        {
            $allArticles[] = $this->createModel($article);
        }
        return $allArticles;
    }

    public function show(int $articleId): ?Article
    {
        $article = $this->builder
            ->select('*')
            ->from('articles')
            ->where('id = :id')
            ->setParameter('id',$articleId)
            ->fetchAssociative();

        return $this->createModel($article);
    }

    public function store(Article $article): Article
    {
        $this->builder
            ->insert('articles')
            ->values
            ([
                'user_id'=>'?',
                'title'=>'?',
                'body'=>'?',
                'created_at'=>'?'
            ])
            ->setParameter(0, $article->getUserId())
            ->setParameter(1, $article->getTitle())
            ->setParameter(2, $article->getArticleBody())
            ->setParameter(3, $article->getCreatedAt())
            ->executeStatement();

        $article->setId((int)($this->connection->lastInsertId()));
        return $article;
    }

    public function edit(Article $article): ?Article
    {
        $this->builder
            ->update('articles')
            ->set('title', '?')
            ->set('body', '?')
            ->where('id', '?')
            ->setParameter(0, $article->getTitle())
            ->setParameter(1, $article->getArticleBody())
            ->setParameter(2, $article->getId())
            ->executeStatement();
    }

    private function createModel(array $article): Article
    {
        return new Article
        (
            (int)$article['user_id'],
            $article['title'],
            $article['body'],
            'https://placehold.co/600x400/green/white/?text=Code',
            $article['created_at'],
            (int)$article['id']
        );
    }
}