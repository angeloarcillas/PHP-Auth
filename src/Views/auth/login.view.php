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
        <div class="w-1/3 mx-auto p-6 border-2 border-blue-400 rounded">
          <h2 class="mb-6 text-2xl font-bold text-center">Login to an existing account
            <p class="text-sm font-normal">or
              <a href="#login" class="text-blue-400"> Sign up</a>
              an account.
            </p>
          </h2>
          <form action="/php-auth/register" method="POST">
            <div class="my-4 text-sm text-red-500">
              <ul class="list-disc list-inside">
                <?php if (isset($_SESSION['errors'])) : ?>
                  <?php foreach ($_SESSION['errors'] as $error) : ?>
                    <li><?php echo $error ?></li>
                  <?php endforeach ?>
                <?php endif ?>
              </ul>
            </div>

            <?php echo csrf_field() ?>

            <div class="mb-6">
              <label for="email" class="block mb-1 text-sm font-bold text-gray-500">Email</label>
              <input type="email" name="email" placeholder="email..." id="email" class="w-full p-2 border rounded">
            </div>
            <div class="mb-6">
              <label for="password" class="block mb-1 text-sm font-bold text-gray-500">Password</label>
              <input type="password" name="password" placeholder="password..." id="password" class="w-full p-2 border rounded">
            </div>
            <div class="mb-6">
              <button class="w-full py-2 px-3 font-bold text-white bg-blue-400 rounded">Sign in</button>
            </div>
          </form>
        </div>

      </div>
    </main>
  </div>
</body>

</html>
