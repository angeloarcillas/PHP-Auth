<?php if (isset($_SESSION['errors'])) : ?>
  <div class="my-4 text-sm text-red-500">
    <ul class="list-disc list-inside">

      <!-- Errors -->
      <?php foreach ($_SESSION['errors'] as $error) : ?>
        <li><?php echo $error ?></li>
      <?php endforeach ?>
    
    </ul>
  </div>
<?php endif ?>
