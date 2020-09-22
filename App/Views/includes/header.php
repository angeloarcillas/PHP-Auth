<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP-Auth</title>

  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
  <header>
    <div class="navbar">
      <h1>Foobar</h1>

      <div id="menu">
        <svg viewBox="0 0 100 80" width="40" height="40">
          <rect width="70" height="10"></rect>
          <rect y="20" width="70" height="10"></rect>
          <rect y="40" width="70" height="10"></rect>
        </svg>
      </div>
    </div>

    <div class="main--nav">
      <span class="close">&times;</span>

      <nav>
        <a href="/PHP-Auth/truncate">Truncate</a>
        <a href="#">Users</a>
        <a href="/PHP-Auth/auth/password/reset">Reset</a>
        <a href="/PHP-Auth/auth/email/verify/link">Verify Email</a>
      </nav>
    <div>
      <?php if ( isset($_SESSION['auth']['name'])): ?>
      <a href="/PHP-Auth/auth/login">Login</a>
      <a href="/PHP-Auth/auth/register">Register</a>

      <?php else: ?>
      <a
      href="#" class="nav-link"
      onclick="event.preventDefault();
      document.querySelector('#logout-form').submit()"
      >Logout</a>

      <form
      id="logout-form"
      class="none"
      action="/PHP-Auth/auth/logout"
      method="post">
      </form>
      <?php endif; ?>
    </div>
  </div>
</header>

<main>
  <div class="container mx-auto">
