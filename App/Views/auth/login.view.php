<?php view_path('includes/header') ?>
<div class="mb-6 border-b border-gray-400">
  <h2
    class="text-lg md:text-4xl text-gray-900 uppercase font-bold">
    Login
  </h2>
</div>
<div class="mb-6">
  <form name="login" action="/PHP-Auth/login"
    method="POST" onsubmit="loginForm()">

    <div class="mb-4">
      <label
        class="block mb-2 text-sm text-gray-700 font-bold">
        Email
      </label>
      <input
        class="w-full py-2 px-4 text-gray-700 border rounded appearance-none focus:border-blue-100 focus:shadow-outline outline-none"
        type="text" placeholder="example@mail.com"
        name="email"
        autofocus>
      <p class="text-red-500 text-xs italic"></p>
    </div>

    <div class="mb-4">
      <label
        class="block mb-2 text-sm text-gray-700 font-bold">
        Password
      </label>
      <input
        class="w-full py-2 px-4 text-gray-700 border rounded appearance-none focus:border-blue-100 focus:shadow-outline outline-none"
        type="password"
        placeholder="******************"
        name="password">
      <p class="text-red-500 text-xs italic"></p>
    </div>

    <div
      class="flex items-center justify-between">
      <button
        class="py-2 px-6 border font-semibold text-white bg-blue-400 rounded hover:bg-blue-500"
        type="submit">
        Sign In
      </button>
      <a class="text-sm text-blue-500 hover:underline hover:text-blue-600"
        href="/PHP-Auth/password/forgot">
        Forgot Password?
      </a>
    </div>
  </form>
</div>
<?php view_path('includes/footer'); ?>