<?php require_once "App/Views/layout/header.php"; ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Please Verify Your Email Address</div>
        </div>
        <div class="card-body">
          <form action="PHP-Auth/auth/email/verify/link" method="POST">
            <button type="submit" class="btn btn-primary">Resend Email Verification</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once "App/Views/layout/header.php"; ?>