<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | M.A</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('_assets/css/all.min.css')}}">
</head>

<body class="hold-transition sidebar-mini">


<div class="wrapper">
    <div class="container ">
            <div class="row">
                <div class="col-md-4 mx-auto mt-5">
                    <div class="card">
                        <div class="card-body login-card-body">
                            <p class="login-box-msg">Login</p>

                            <form action="{{ route('admin.login') }}" method="post">
                                @csrf
                                @error('email')
                                   <small class="text-danger">{{$message}}</small>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('password')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
{{--                                        <div class="icheck-primary">--}}
{{--                                            <input type="checkbox" id="remember" value="1" name="remember_token">--}}
{{--                                            <label for="remember">--}}
{{--                                                Remember Me--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                    </div>
                                </div>
                            </form>
                            {{--                            <p class="mb-1">--}}
                            {{--                                <a href="forgot-password.html">I forgot my password</a>--}}
                            {{--                            </p>--}}
                            {{--                            <p class="mb-0">--}}
                            {{--                                <a href="register.html" class="text-center">Register a new membership</a>--}}
                            {{--                            </p>--}}
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>


</body>
</html>
