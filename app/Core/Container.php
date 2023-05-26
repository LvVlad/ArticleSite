<?php

namespace App\Core;

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\JsonPlaceholderArticleRepository;
use App\Repositories\Comments\CommentsRepository;
use App\Repositories\Comments\JsonPlaceholderCommentsRepository;
use App\Repositories\User\JsonPlaceholderUserRepository;
use App\Repositories\User\UserRepository;
use DI\ContainerBuilder;

class Container
{
    private ContainerBuilder $builder;

    public function __construct()
    {
        $this->builder = new ContainerBuilder();
        $this->builder->addDefinitions([
            ArticleRepository::class => new JsonPlaceholderArticleRepository(),
            UserRepository::class => new JsonPlaceholderUserRepository(),
            CommentsRepository::class => new JsonPlaceholderCommentsRepository()
        ]);
    }

    public function getContainer()
    {
        return $this->builder->build();
    }
}