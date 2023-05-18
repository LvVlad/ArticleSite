<?php declare(strict_types=1);

namespace App\Core;

use FastRoute;
use App\Controllers\ArticleController;

class Router
{

    public static function response()
    {
        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
            $route->addRoute('GET', '/', ['App\Controllers\ArticleController', 'index']);
            $route->addRoute('GET', '/articles', ['App\Controllers\ArticleController', 'index']);
            $route->addRoute('GET', '/article/{id:\d+}', ['App\Controllers\ArticleController', 'show']);
            $route->addRoute('GET', '/user/{id:\d+}', ['App\Controllers\UserController', 'show']);
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
                return (new $controller)->{$method}($vars);
        }
        return null;
    }
}