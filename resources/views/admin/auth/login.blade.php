<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>AdminLTE 3 | Đăng nhập</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{asset('assets/backend/plugins/fontawesome-free/css/all.min.css')}}">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{asset('assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{asset('assets/backend/dist/css/adminlte.min.css')}}">
   </head>
   <body class="login-page" style="min-height: 496.781px;">
      <div class="login-box">
         <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
         </div>
         <!-- /.login-logo -->
         <div class="card">
            <div class="card-body login-card-body">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="login-box-msg">{{ $error }}</p>
                    @endforeach
                @endif
               <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" id="email" type="text" name="email" value="{{ old('email') }}" required="required"  autofocus="autofocus">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-envelope"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" class="form-control" id="password" type="password" name="password" required="required" autocomplete="current-password">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-8">
                        <div class="icheck-primary">
                           <input type="checkbox" id="remember_me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                           <label for="remember">
                           Nhớ tài khoản
                           </label>
                        </div>
                     </div>
                     <!-- /.col -->
                     <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                     </div>
                     <!-- /.col -->
                  </div>
               </form>
            </div>
            <!-- /.login-card-body -->
         </div>
      </div>
      <!-- /.login-box -->
      <!-- jQuery -->
      <script src="../../plugins/jquery/jquery.min.js"></script>
      <!-- Bootstrap 4 -->
      <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- AdminLTE App -->
      <script src="../../dist/js/adminlte.min.js"></script>
   </body>
</html>