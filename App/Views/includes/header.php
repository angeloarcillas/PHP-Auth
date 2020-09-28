<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <title>PHP-Auth</title>

  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap"
    rel="stylesheet">
  <link
    href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
    rel="stylesheet">
  <script src="<?php echo assets('js/main.js')?>"
    defer></script>

</head>

<body class="bg-gray-200">
  <header
    class="md:flex items-center min-h-20 p-6 bg-white shadow">
    <div class="md:mr-4 md:w-32">
      <h1 class="text-2xl font-semibold">PHP-Auth
      </h1>
    </div>
    <?php view_path('includes/nav'); ?>
  </header>
  <main>
    <div
      class="min-h-screen container mx-auto px-6 p-12">
      <div
        class="md:w-2/3 mx-auto p-6 bg-white rounded shadow">