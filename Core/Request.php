<?php
namespace Core;

use Exception;

class Request
{
    /**
     * Get request url w/out ?(Get request)
     */
    public static function uri(): string
    {
        // strip extra slashes
        $uri = trim($_SERVER['REQUEST_URI'], '/');

        // return url w/out  Get request
        return reset(...[explode('?', $uri)]);
    }

    /**
     * Get request method
     */
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get request variables
     */
    public static function request(): array
    {
        if (empty($_REQUEST)) {
            throw new Exception("Empty request");
        }

        return array_map(function ($request) {
            return strip_tags(htmlspecialchars($request));
        }, $_REQUEST);
    }

    /**
     * Get query string variables
     */
    public static function query(?string $key = null)
    {
        if (!$key) {
            return $_GET;
        }

        if (array_key_exists($key, $_GET)) {
            return $_GET[$key];
        }

        return null;
        // throw new Exception("Query {$key} doesnt exist");
    }
}
