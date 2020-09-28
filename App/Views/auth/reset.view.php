<?php view_path('includes/header') ?>

<div class="mb-6 border-b border-gray-400">
  <h2
    class="text-lg md:text-4xl text-gray-900 uppercase font-bold">
    Reset password
  </h2>
</div>

<div class="mb-6">
  <form action="#">

    <div class="mb-4">
      <label
        class="block mb-2 text-sm text-gray-700 font-bold">Old
        password</label>
      <input
        class="w-full py-2 px-4 text-gray-700 border rounded appearance-none focus:border-blue-100 focus:shadow-outline outline-none"
        type="password" name="old_password"
        placeholder="*********" autofocus>
    </div>

    <div class="mb-4">
      <label
        class="block mb-2 text-sm text-gray-700 font-bold">New
        password
      </label>
      <input
        class="w-full py-2 px-4 text-gray-700 border rounded appearance-none focus:border-blue-100 focus:shadow-outline outline-none"
        type="password" name="old_password"
        placeholder="*********" autofocus>
    </div>

    <div class="mb-4">
      <label
        class="block mb-2 text-sm text-gray-700 font-bold">Confirm
        password
      </label>
      <input
        class="w-full py-2 px-4 text-gray-700 border rounded appearance-none focus:border-blue-100 focus:shadow-outline outline-none"
        type="password" name="old_password"
        placeholder="*********" autofocus>
    </div>

    <button
      class="mt-4 py-2 px-4 text-white bg-red-400 rounded hover:bg-red-500">Reset
      password</button>
  </form>
</div>
<?php view_path('includes/footer') ?>