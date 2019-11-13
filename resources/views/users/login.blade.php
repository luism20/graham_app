<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{$title}}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href='{{ asset('css/bootstrap/css/bootstrap.min.css') }}'>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('css/AdminLTE.css') }}">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="{{asset('img/logo.png')}}" class="img-responsive">
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Login</p>

                @if(session('mensaje'))
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('mensaje') }}
                </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input id="email" type="email" class="form-control" placeholder="E-mail" name="email" value="{{ old('email') }}">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input id="password" type="password" class="form-control" placeholder="Password" name="password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-success btn-block btn-flat">Log in</button>
                        </div>
                    </div>
                </form>
                <a href="{{ url('/register') }}">Sign up</a><br>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 2.2.3 -->
        <script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <!-- iCheck -->
        <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });

                localStorage.CANTNOTIF = 0;
            });
        </script>
    </body>
</html>

