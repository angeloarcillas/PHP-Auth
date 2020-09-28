  <div
    class="text-sm md:flex justify-between w-full">

    <!-- MAIN NAV -->
    <nav>
      <a class="block md:inline-block mr-2 hover:text-blue-500"
        href="/PHP-Auth/truncate">Truncate
      </a>
      <a class="block md:inline-block mr-2 hover:text-blue-500"
        href="/PHP-Auth/user/foo/email/bar">Users
      </a>
      <a class="block md:inline-block mr-2 hover:text-blue-500"
        href="/PHP-Auth/password/forgot">Forgot
      </a>
      <a class="block md:inline-block mr-2 hover:text-blue-500"
        href="/PHP-Auth/password/reset">Reset
      </a>
    </nav>

    <div>
      <?php if (! isset($_SESSION['auth']['name'])): ?>
      <a class="block md:inline-block mr-2 hover:text-blue-500"
        href="/PHP-Auth/login">Login
      </a>
      <a class="block md:inline-block hover:text-blue-500"
        href="/PHP-Auth/register">Register</a>

      <?php else: ?>
      <a class="hover:text-blue-500" href="#"
        onclick="event.preventDefault();
        document.querySelector('#logout-form').submit()">Logout</a>

      <form id="logout-form" class="none"
        action="/PHP-Auth/logout" method="post">
      </form>
      <?php endif; ?>
    </div>
  </div>