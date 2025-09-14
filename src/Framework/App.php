<?php

declare(strict_types=1);

namespace Framework;

class App
{
    private Router $router;
    private Container $container;

    public function __construct(string $containerDefinitionsPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();

        if ($containerDefinitionsPath) {
            $containerDefinitions = include $containerDefinitionsPath;
            $this->container->addDefinitions($containerDefinitions);
        }
    }

    /**
     * Register a GET route
     */
    public function getRoute(string $path, array $controller): void
    {
        $this->router->addRoute('GET', $path, $controller);
    }

    /**
     * Register a POST route
     */
    public function postRoute(string $path, array $controller): void
    {
        $this->router->addRoute('POST', $path, $controller);
    }

    /**
     * Register a route for any method
     */
    public function anyRoute(string $method, string $path, array $controller): void
    {
        $this->router->addRoute(strtoupper($method), $path, $controller);
    }

    /**
     * Run the application: dispatch current request
     */
    public function run(): void
    {
        $this->router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $this->container);
    }

    /**
     * Add a middleware
     */
    public function addMiddleware(string $middlewareClass): void
    {
        $this->router->addMiddleware($middlewareClass);
    }
}
