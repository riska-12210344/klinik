<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
            <form action="<?= base_url() ?>/login/action" method="post">
            <?= csrf_field(); ?>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
              </div>

              <div class="form-group mb-3 text-center">
                <a href="/forgot" style="margin-right:15px">Forgot Password ?</a>
                <a href="/register" style="margin-left:15px">Don't have account ?</a>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign
                  in</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>