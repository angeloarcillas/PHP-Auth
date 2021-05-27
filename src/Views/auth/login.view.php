<?php include_html('header') ?>

<div class="w-1/3 mx-auto p-6 border-2 border-blue-400 rounded">
  <h2 class="mb-6 text-2xl font-bold text-center">Login to an existing account
    <p class="text-sm font-normal">or
      <a href="#login" class="text-blue-400"> Sign up</a>
      an account.
    </p>
  </h2>

  <form action="/php-auth/register" method="POST">
    <?php include_html('errors') ?>

    <?php echo csrf_field() ?>

    <!-- Email Address -->
    <div class="mb-6">
      <label for="email" class="block mb-1 text-sm font-bold text-gray-500">Email Adress</label>
      <input type="email" name="email" placeholder="email..." id="email" class="w-full p-2 border rounded">
    </div>

    <!-- Password -->
    <div class="mb-6">
      <label for="password" class="block mb-1 text-sm font-bold text-gray-500">Password</label>
      <input type="password" name="password" placeholder="password..." id="password" class="w-full p-2 border rounded">
    </div>

    <!-- Sign in -->
    <div class="mb-6">
      <button class="w-full py-2 px-3 font-bold text-white bg-blue-400 rounded">Sign in</button>
    </div>
  </form>
</div>

<?php include_html('footer') ?>
