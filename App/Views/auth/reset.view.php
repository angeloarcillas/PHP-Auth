<?php require_once "App/Views/layout/header.php"; ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Reset Password</div>
        </div>
        <div class="card-body">
          <form action="/PHP-Auth/auth/email/verify/link" method="POST">
            <input type="password" name="password">
            <input type="password" name="confirmPassword">
            <button type="submit" class="btn btn-primary">Reset Password</button> </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php dd($token, $_SESSION['token']) ?>
<?php require_once "App/Views/layout/header.php"; ?>