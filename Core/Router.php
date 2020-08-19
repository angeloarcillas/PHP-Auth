<?php
namespace Core;

use Exception;

class Router
{
    private $controllerNamespace = "App\\Controllers\\";
    private $validMethods = ['GET','POST'];
    private $routes = [
        'GET' => [],
        'POST' => []
    ];
    private $params = null;

    /**
     * instance router then set routes
     *
     * @param mixed $file
     * @return object
     */
    public static function load(string $file): object
    {
        $router = new static;
        require $file;
        return $router;
    }

    /**
     * set GET routes
     *
     * @param string $uri
     * @param string $controller
     */
    private function get(string $uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * set POST routes
     *
     * @param string $uri
     * @param string $controller
     */
    private function post(string $uri, string $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    // !USE REQUEST HEADERS
    // private function put(string $uri, string $controller)
    // {
    //     $this->routes['PUT'][$uri] = $controller;
    // }
    // private function patch(string $uri, string $controller)
    // {
    //     $this->routes['PATCH'][$uri] = $controller;
    // }
    // private function delete(string $uri, string $controller)
    // {
    //     $this->routes['DELETE'][$uri] = $controller;
    // }

    /**
     * process route
     *
     * @param string $uri
     * @param string $method
     * @return mixed
     */
    public function direct(string $uri, string $method)
    {
        if (!$this->isValidMethod($method)) {
            throw new Exception("Invalid request method");
        }


        if (array_key_exists($uri, $this->routes[$method])) {
            if (is_callable($this->routes[$method][$uri])) {
                $this->routes[$method][$uri]();
                exit;
            }

            return $this->callAction(
                ...explode('@', $this->routes[$method][$uri])
            );
        }

        foreach ($this->routes[$method] as $route => $controller) {
            preg_match_all('/{(\w+)}/', $route, $matches);
            $key = array_pop($matches);
            $pattern = preg_replace('/{([\w]+)}/', '(\w+)', $route);

            if (preg_match('/^' . str_replace('/', '\/', $pattern) . '$/', $uri, $match)) {
                $value = array_splice($match, 1);
                $this->params = array_combine($key, $value);
                
                if (is_callable($controller)) {
                    $controller($this->params);
                    exit;
                }

                return $this->callAction(
                    ...explode('@', $controller)
                );
            }
        }

        throw new Exception("No routes defined for this url");
    }


    /**
     * validate if request method is valid
     * @param string $method
     * @return bool
     */
    private function isValidMethod(string $method): bool
    {
        return in_array($method, $this->validMethods);
    }

    /**
     * execute action
     *
     * @param string $controller
     * @param string $action
     *
     * @return mixed
     */
    private function callAction(string $controller, string $action)
    {
        $class = $this->controllerNamespace . $controller;

        if (!class_exists($class)) {
            throw new Exception("No Class defined for this URI.");
        }

        $controller = new $class;

        if (!method_exists($controller, $action)) {
            throw new Exception("No Method defined for this URI.");
        }

        return $controller->$action($this->params);
    }
}
