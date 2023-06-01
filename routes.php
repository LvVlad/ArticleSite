<?php declare(strict_types=1);

return
    [
        //Display Articles
        ['GET', '/', ['App\Controllers\Article\IndexArticleController', 'index']],
        ['GET', '/articles', ['App\Controllers\Article\IndexArticleController', 'index']],
        ['GET', '/article/{id:\d+}', ['App\Controllers\Article\ShowArticleController', 'show']],
        ['GET', '/article/create', ['App\Controllers\Article\CreateArticleController', 'create']],
        ['POST', '/articles', ['App\Controllers\Article\CreateArticleController', 'store']],
        //Display user
        ['GET', '/user/{id:\d+}', ['App\Controllers\UserController', 'show']],
    ];