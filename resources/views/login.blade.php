<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Admin | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style>
        .err_msg {
            color: red;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>Shop</b>Admin</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your journey</p>
                <p class="help-block err_msg" id="err_message" name="err_message"></p>
            <form id="loginForm">
                {{ csrf_field() }}

                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email"/>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <p class="help-block err_msg" id="err_email" name="err_email"></p>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password"/>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <p class="help-block err_msg" id="err_password" name="err_password"></p>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <input type="button" name="login" class="btn btn-primary" onclick="loginPost()" value="Login"/>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-0">
                <a href="{{url('register')}}" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<script src="/plugins/jquery/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="/plugins/custom/common.js"></script>

</body>
</html>
