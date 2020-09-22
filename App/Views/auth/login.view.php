<?php view_path('includes/header') ?>

<div class="w-full max-w-xs mx-auto pt-6">

  <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="border-b mb-6">
      <h2 class="text-gray-700 text-xl uppercase font-bold">Login</h2>
    </div>
    <form name="login" action="/PHP-Auth/auth/login" method="POST" onsubmit="loginForm()">
    <?php
    if(isset($_SESSION['error'])) {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
    ?>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">
          Email
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-blue-400"
          type="text" placeholder="example@mail.com" name="email">
        <p class="text-red-500 text-xs italic"></p>
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2">
          Password
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:border-blue-400"
          type="password" placeholder="******************" name="password">
        <p class="text-red-500 text-xs italic"></p>
      </div>
      <div class="flex items-center justify-between">
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          type="submit">
          Sign In
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
          Forgot Password?
        </a>
      </div>
    </form>
  </div>
</div>

<?php view_path('includes/footer'); ?>