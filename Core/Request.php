<?php
namespace Core;

use Exception;

class Request
{
    public static function uri(): string
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        return reset(...[explode('?', $uri)]);
    }
    
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    public static function request(): array
    {
        if (empty($_REQUEST)) {
            throw new Exception("Empty request");
        }

        return array_map(function ($request) {
            return strip_tags(htmlspecialchars($request));
        }, $_REQUEST);
    }

    public static function query($key = false)
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
