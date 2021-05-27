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

/**
 * Set csrf token
 */
if (!function_exists('csrf_token')) {
    function csrf_token()
    {
        // check if token already set
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION["csrf_token"] = bin2hex(random_bytes(32)); // hash
            $_SESSION["csrf_lifespan"] = time() + 3600; // +60 minutes
            return $_SESSION["csrf_token"];
        }

        // return existing token
        // usable for one or more csrf field
        return $_SESSION["csrf_token"];
    }
}

/**
 * Create csrf field
 *
 * @return string
 */

if (!function_exists('csrf_field')) {
    function csrf_field()
    {
        return '<input type="hidden" name="_csrf" value="' . csrf_token() . '">';
    }
}

/**
 * Verify CSRF token
 */

if (!function_exists('verifyCsrf')) {
    function verifyCsrf(string $hash)
    {
        // check if csrf token exists
        if (!isset($_SESSION['csrf_token'])) return false;

        // check if csrf token exired
        $expired = $_SESSION['csrf_lifespan'] < time();

        // compare csrf token and csrf field
        $matched = hash_equals($_SESSION['csrf_token'],  $hash);

        // remove csrf sessions
        unset($_SESSION['csrf_token']);
        unset($_SESSION['csrf_lifespan']);

        if ($expired || !$matched) {
            $_SESSION['errors'] = ['csrf' => 'csrf token didnt match.'];

            return redirect()->back();
            // return false
        };

        // csrf token and csrf field matched
        return true;
    }
}

if (!function_exists('include_html')) {
    function include_html(string $filename)
    {
        return require_once "src/Views/includes/{$filename}.view.php";
    }
}
