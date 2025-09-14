<?php
namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    private function normalizePath(string $path): string
    {
        // Always start with a single slash, no trailing slash
        $path = '/' . trim($path, '/');
        return $path === '/' ? $path : rtrim($path, '/');
    }

    public function addRoute(string $method, string $path, array $controller): void
    {
        $this->routes[] = [
            'method'     => strtoupper($method),
            'path'       => $this->normalizePath($path),
            'controller' => $controller
        ];
    }

    public function addMiddleware(string $middlewareClass): void
    {
        $this->middlewares[] = $middlewareClass;
    }

    public function dispatch(string $method, string $path, Container $container): void
    {
        // Remove query string part (?foo=bar)
        $path = parse_url($path, PHP_URL_PATH);
        $normalizedPath = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $normalizedPath) {
                [$controllerClass, $controllerMethod] = $route['controller'];

                if (!class_exists($controllerClass) || !method_exists($controllerClass, $controllerMethod)) {
                    http_response_code(500);
                    echo "Controller or method not found.";
                    return;
                }

                $controllerInstance = $container->get($controllerClass);

                // Core action = controller call
                $action = fn() => $controllerInstance->$controllerMethod();

                // Wrap middlewares around action
                foreach (array_reverse($this->middlewares) as $middlewareClass) {
                    $middlewareInstance = $container->get($middlewareClass);
                    $next = $action;
                    $action = fn() => $middlewareInstance->process($next);
                }

                $action();
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
