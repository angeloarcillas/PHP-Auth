<?php view_path('includes/header') ?>

<div class="mb-6 border-b border-gray-400">
  <h2
    class="text-lg md:text-4xl text-gray-900 uppercase font-bold">
    Register</h2>
</div>

<div class="mb-6">
  <form name="register"
    action="/PHP-Auth/register" method="POST"
    onsubmit="registerForm()">
    <div class="mb-4">
      <label
        class="block mb-2 text-sm text-gray-700 font-bold">
        Name
      </label>
      <input
        class="w-full py-2 px-4 text-gray-700 border rounded appearance-none focus:border-blue-100 focus:shadow-outline outline-none"
        type="text" placeholder="John Doe"
        name="name" autofocus>
      <p class="text-red-500 text-xs italic">
      </p>
    </div>

    <div class="mb-4">
      <label
        class="block mb-2 text-sm text-gray-700 font-bold">
        Email
      </label>
      <input
        class="w-full py-2 px-4 text-gray-700 border rounded appearance-none focus:border-blue-100 focus:shadow-outline outline-none"
        type="email"
        placeholder="example@mail.com"
        name="email">
      <p class="text-red-500 text-xs italic">
      </p>
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
      <p class="text-red-500 text-xs italic">
      </p>
    </div>

    <div class="mb-4">
      <label
        class="block mb-2 text-sm text-gray-700 font-bold">
        Confirm Password
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:border-blue-400"
        type="password"
        placeholder="******************"
        name="password_confirmation">
      <p class="text-red-500 text-xs italic">
      </p>
    </div>

    <div
      class="flex items-center justify-between">
      <button
        class="py-2 px-6 border font-semibold text-white bg-blue-400 rounded hover:bg-blue-500"
        type="submit">
        Register
      </button>
      <a class="text-sm text-blue-500 hover:underline hover:text-blue-600"
        href="/PHP-Auth/login">
        Already Registered?
      </a>
    </div>
  </form>
</div>

<?php view_path('includes/footer'); ?>