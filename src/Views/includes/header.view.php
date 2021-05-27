<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP-Auth - Login</title>

  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
  <div id="app" class="p-12 pt-6">
    <header class="flex items-end h-20 mb-6 p-4">
      <div class="mr-6 text-4xl">
        <h1>PHP-Auth</h1>
      </div>
      <div class="flex justify-between flex-1 text-sm">
        <nav class="flex gap-5">
          <a href="#">Dashboard</a>
          <a href="#">Users</a>
        </nav>
        <div class="flex gap-5">
          <a href="/php-auth/login" class="text-blue-400">Login</a>
          <a href="/php-auth/register">Register</a>
        </div>
      </div>
    </header>
    <main>
      <div class="h-screen">
