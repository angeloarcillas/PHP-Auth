<?php

/**
 * Encode string
 *
 * @param string $string
 */
if (!function_exists("e")) {
    function e(string $string)
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}

/**
 * Require a view.
 *
 * @param  string $path
 * @param  array  $data
 */
if (!function_exists("view")) {
    function view(string $path, array $data = [])
    {
        // convert array to variable
        extract($data);

        // convert users.create to users/create
        $realSubPath = str_replace('.', '/', e($path));

        // path of file to rquire
        $realPath = "src/Views/{$realSubPath}.view.php";

        // require file
        return require_once $realPath;
    }
}
