<?php view_path('includes/header') ?>

 <div class="w-2/3 mx-auto border border-gray-200 p-6 rounded shadow">
     <div class="border-b mb-6">
     <h2 class="text-4xl uppercase font-bold">
     Welcome,
     <?php
     echo $_SESSION['auth']['name'];
     ?>
     </h2>
     </div>
    </div>

<?php require_once "App/Views/includes/footer.php"; ?>