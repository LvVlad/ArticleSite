<?php declare(strict_types=1);

namespace App\Core;

use FastRoute;
use App\Controllers\PostController;

class Router
{
    private string $PostController = 'App\Controllers\PostController';

    public static function route()
    {
        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
            $route->addRoute('GET', '/', [$this->PostController, 'articles']);
            $route->addRoute('GET', '/articles', [$this->PostController, 'articles']);
            $route->addRoute('GET', '/article/{id:\d+}', [$this->PostController, 'singleArticle']);
            $route->addRoute('GET', '/user/{id:\d+}', [$this->PostController, 'user']);
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                return null;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                return null;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                [$controller, $method] = $handler;
                $controller = new PostController;
                return $controller->{$method}($vars);
        }
        return 'is it working?';
    }
}