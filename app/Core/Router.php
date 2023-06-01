<?php declare(strict_types=1);

namespace App\Core;

use App\Core\Redirect\Redirect;
use App\Core\Redirect\Response;
use FastRoute;

class Router
{
    public static function response(array $routes): ?Response
    {
        $container = (new Container())->getContainer();

        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) use ($routes)
        {
            foreach ($routes as $route)
            {
                [$method, $path, $handler] = $route;
                $router->addRoute($method, $path, $handler);
            }
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?'))
        {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0])
        {
            case FastRoute\Dispatcher::NOT_FOUND:
                return null;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                return null;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                [$controllerName, $methodName] = $handler;
                $controller = $container->get($controllerName);

                return $controller->{$methodName}($vars);
        }
        return new Redirect('/');
    }
}