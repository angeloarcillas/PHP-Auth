<?php require_once "App/Views/layout/header.php"; ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Register</div>

        <div class="card-body">
          <form method="POST" action="/PHP-Auth/auth/register">
            <?php echo csrf_field() ?>
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Username</label>

              <div class="col-md-6">
                <input type="text" class="form-control is-invalid" name="username" required autofocus>

                <span class="invalid-feedback" role="alert">
                  <strong>Invalid Feedback</strong>
                </span>

              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Email Address</label>

              <div class="col-md-6">
                <input type="email" class="form-control" name="email" required>
              </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Password</label>

              <div class="col-md-6">
                <input type="password" class="form-control" name="password" required>
              </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Confirm Password</label>

              <div class="col-md-6">
                <input type="password" class="form-control" name="confirmPassword" required>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once "App/Views/layout/header.php"; ?>