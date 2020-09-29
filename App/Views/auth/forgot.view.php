<?php view_path('includes/header') ?>

<div class="mb-6 border-b border-gray-400">
  <h2
    class="text-lg md:text-4xl text-gray-900 uppercase font-bold">
    Forgot password
  </h2>
</div>

<div class="mb-6">
  <form action="/PHP-Auth/password/forgot"
    method="POST">
    <!-- CSRF -->

    <label
      class="block mb-2 text-sm text-gray-700 font-bold">
      Email
    </label>
    <input
      class="w-full py-2 px-4 text-gray-700 border rounded appearance-none focus:border-blue-100 focus:shadow-outline outline-none"
      type="email" name="email"
      placeholder="Enter your email address"
      autofocus>
    <button
      class="mt-4 py-2 px-4 text-white bg-blue-400 rounded hover:bg-blue-500">Request
      password reset</button>
  </form>
</div>
<?php view_path('includes/footer') ?>