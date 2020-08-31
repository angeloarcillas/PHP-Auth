<?php require_once "App/Views/layout/header.php"; ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Reset Password</div>
        </div>
        <div class="card-body">
          <form action="/PHP-Auth/auth/password/reset" method="POST">
            <?php echo csrf_field() ?>
            <!-- hidden email & token -->

            <div class="form-group">
              <label>New password</label>
              <input class="form-control" type="password" name="password">
            </div>

            <div class="form-group">
              <label>Confirm password</label>
              <input class="form-control" type="password" name="confirmPassword">
            </div>

            <button type="submit" class="btn btn-primary">Reset Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once "App/Views/layout/header.php"; ?>