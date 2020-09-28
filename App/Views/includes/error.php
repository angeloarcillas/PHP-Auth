<div class="mt-2 mb-1 text-red-400 italic">
  <ul>
    <?php foreach ($_SESSION['error'] as $error): ?>

    <li><?php echo e($error) ?></li>

    <?php
    endforeach;
    unset($_SESSION['error']);
    ?>
  </ul>
</div>