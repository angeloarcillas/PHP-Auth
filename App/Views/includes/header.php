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
  <header class="flex items-center h-20 border p-6">
  <div class="mr-4 w-40">
  <h1 class="text-2xl font-bold">PHP-Auth</h1>
  </div>
  <div class="text-sm flex justify-between w-full">

  <!-- MAIN NAV -->
      <nav>
        <a
          class="mr-2 hover:text-blue-500"
          href="/PHP-Auth/truncate"
        >Truncate</a>
        <a
          class="mr-2 hover:text-blue-500"
          href="#"
        >Users</a>
        <a
          class="mr-2 hover:text-blue-500"
          href="/PHP-Auth/auth/password/reset"
        >Reset</a>
        <a
          class="mr-2 hover:text-blue-500"
          href="/PHP-Auth/auth/email/verify/link"
        >Verify Email</a>
      </nav>

    <div>
      <?php if (! isset($_SESSION['auth']['name'])): ?>
      <a
        class="mr-2 hover:text-blue-500"
        href="/PHP-Auth/auth/login"
      >Login
      </a>
      <a
        class="hover:text-blue-500"
        href="/PHP-Auth/auth/register"
      >Register</a>

      <?php else: ?>
      <a
        class="hover:text-blue-500"
        href="#"
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
  <div class="p-6 container mx-auto min-h-screen">