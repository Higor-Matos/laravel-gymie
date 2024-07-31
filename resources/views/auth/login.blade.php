<!DOCTYPE html>
<html lang="pt-BR">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <title>The Black's Thai - Login</title>

    <!-- BEGIN CORE FRAMEWORK -->
    <link href="{{ secure_asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ secure_asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet"/>
    <link href="{{ secure_asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <!-- END CORE FRAMEWORK -->

    <!-- BEGIN PLUGIN STYLES -->
    <link href="{{ secure_asset('assets/plugins/animate/animate.css') }}" rel="stylesheet"/>
    <link href="{{ secure_asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <!-- END PLUGIN STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="{{ secure_asset('assets/css/material.css') }}" rel="stylesheet"/>
    <link href="{{ secure_asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ secure_asset('assets/css/plugins.css') }}" rel="stylesheet"/>
    <link href="{{ secure_asset('assets/css/helpers.css') }}" rel="stylesheet"/>
    <link href="{{ secure_asset('assets/css/responsive.css') }}" rel="stylesheet"/>
    <link href="{{ secure_asset('assets/css/mystyle.css') }}" rel="stylesheet"/>
    <!-- END THEME STYLES -->
</head>
<body class="auth-page height-auto bg-grey-600">
<div class="wrapper animated fadeInDown">
    <div class="panel overflow-hidden">
        <div class="bg-grey-900 padding-40 no-margin-bottom font-size-20 color-white text-center text-uppercase">
            <img src="{{ asset('assets/img/web/logo.png') }}">
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Ops!</strong> Houve alguns problemas com sua entrada.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="loginform" method="post" action="{{ url('/auth/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="box-body padding-md">

                <div class="form-group">
                    <input type="text" name="email" class="form-control input-lg" placeholder="Email"/>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control input-lg" placeholder="Senha"/>
                </div>

                <div class="form-group margin-top-20">
                    <div class="checkbox checkbox-theme">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Lembrar-me</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark padding-10 btn-block color-white" style="background-color: #8B0000; color: white;">
                    <i class="ion-log-in"></i> Entrar
                </button>
            </div>
        </form>
        <div class="panel-footer padding-md no-margin no-border bg-grey-900 text-center color-white">&copy; <?php echo date('Y'); ?> Adaptado por Higor de Deus.</div>
    </div>
</div>

<!-- Javascript -->
<script src="{{ secure_asset('assets/plugins/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ secure_asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ secure_asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ secure_asset('assets/js/core.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- bootstrap validator -->
<script src="{{ secure_asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.js') }}" type="text/javascript"></script>

<!-- Login Validators -->
<script src="{{ secure_asset('assets/js/login.js') }}" type="text/javascript"></script>

<!-- gymie -->
<script src="{{ secure_asset('assets/js/gymie.js') }}" type="text/javascript"></script>
</body>
</html>
