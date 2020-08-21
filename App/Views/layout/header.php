<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo assets("css/main.css") ?>">

  <title>PHP Authentication</title>
</head>

<body>
  <header class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="navbar-brand">
      <a href="/PHP-Auth">PHP-Auth</a>
    </div>

    <div class="collapse navbar-collapse">
      <nav class="navbar-nav mr-auto">
        <a href="/PHP-Auth/truncate" class="nav-link">Truncate</a>
        <a href="#" class="nav-link">Users</a>
        <a href="#" class="nav-link">Articles</a>
        <a href="/PHP-Auth/auth/email/verify/link" class="nav-link">Verify Email</a>

      </nav>

      <div class="navbar-nav ml-auto">
        <?php if (! isset($_SESSION['auth']['name'])): ?>
        <a href="/PHP-Auth/auth/login" class="nav-link">Login</a>
        <a href="/PHP-Auth/auth/register" class="nav-link">Register</a>
        <?php else: ?>
        <a href="#" class="nav-link"
          onclick="event.preventDefault();document.querySelector('#logout-form').submit()">Logout</a>
        <form id="logout-form" action="/PHP-Auth/auth/logout" method="post" style="display: none">
        </form>
        <?php endif; ?>
      </div>
    </div>
  </header>
  <main class="py-4">