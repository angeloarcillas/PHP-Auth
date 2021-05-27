<?php if (isset($_SESSION['errors'])) : ?>
  <div class="my-4 text-sm text-red-500">
    <ul class="list-disc list-inside">

      <?php if (is_string($_SESSION['errors'])) : ?>
        <!-- Single error -->
        <li><?php echo $_SESSION['errors'] ?></li>

      <?php else : ?>
        <!-- multiple errors -->
        <?php foreach ($_SESSION['errors'] as $error) : ?>
          <li><?php echo $error ?></li>
        <?php endforeach ?>

      <?php endif ?>
    </ul>
  </div>
<?php endif ?>
