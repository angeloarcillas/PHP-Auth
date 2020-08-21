<?php require_once "App/Views/layout/header.php"; ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Please Enter Your Email Address</div>
        </div>
        <div class="card-body">
          <form action="/PHP-Auth/auth/email/verify/link" method="POST">
            <div class="form-group">
              <label>Email Address:</label>
              <input class="form-control" type="email" name="email">
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary">Send password reset email</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once "App/Views/layout/header.php"; ?>