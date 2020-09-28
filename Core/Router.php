<?php
namespace Core;

use Exception;

class Router
{
    private $host = "PHP-Auth"; // (OPTIONAL)

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
        $uri = trim($this->host.$uri ,'/');
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * set POST routes
     *
     * @param string $uri
     * @param string $controller
     */
    private function post(string $uri, $controller)
    {
        $uri = trim($this->host.$uri ,'/');
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * process route
     *
     * @param string $uri
     * @param string $method
     * @return mixed
     */
    public function direct(string $uri, string $method)
    {
        // Validate request method
        if (!$this->isValidMethod(strtoupper($method))) {
            throw new Exception("Invalid request method");
        }

        // Loop through routes
        foreach ($this->routes[$method] as $route => $controller) {
            // Check for wildcards
            if (strpos($route, '{')) {
                preg_match_all('/{(\w+)}/', $route, $matches);

                // Set parameter keys
                $key = array_pop($matches);

                // Set pattern for wildcards
                $pattern = preg_replace('/{([\w]+)}/', '(\w+)', $route);

                // Match route
                if (preg_match('/^' . str_replace('/', '\/', $pattern) . '$/', $uri, $match)) {

                    // Set parameter keys value
                    $value = array_splice($match, 1);

                    // Set parameters
                    $this->params = array_combine($key, $value);
                } else {

                    // continue if route with wildcard and URI didnt match
                    continue;
                }
            } else {

                // continue if route w/out wildcard and URI didnt match
                if ($uri !== $route) {
                    continue;
                }
            }

            // Call function if controller is callable
            if (is_callable($controller)) {
                $controller($this->params);
                exit;
            }

            // Call controller
            return $this->callAction(
                ...explode('@', $controller)
            );
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
        return in_array($method, $this->validMethods, true);
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
        // Set class namspace
        $class = $this->controllerNamespace . $controller;

        // Check if class exist
        if (!class_exists($class)) {
            throw new Exception("No Class defined for this Controller.");
        }

        // Create object
        $object = new $class;

        // Check if method exist
        if (!method_exists($object, $action)) {
            throw new Exception("No Method defined for this Class.");
        }

        // Call action from object
        return $object->$action($this->params);
    }
}