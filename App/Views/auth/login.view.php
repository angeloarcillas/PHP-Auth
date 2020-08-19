<?php require_once "App/Views/layout/header.php"; ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Login</div>

        <div class="card-body">
          <form method="POST" action="">

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Username</label>

              <div class="col-md-6">
                <input type="email" class="form-control" name="email" required autofocus>

                <span class="invalid-feedback" role="alert">
                  <strong>Invalid Feedback</strong>
                </span>

              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Password</label>

              <div class="col-md-6">
                <input type="password" class="form-control" name="password" required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember">
                  <label class="form-check-label" for="remember">Remember Me</label>
                </div>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Login</button>
                <a class="btn btn-link" href="#">Forgot Your Password?</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once "App/Views/layout/header.php"; ?>