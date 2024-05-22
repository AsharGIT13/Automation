<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Login | Au2omation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('admin/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <a href="{{route('Authentication')}}" class="mb-5 d-block auth-logo">
                                <img src="{{asset('admin/assets/images/logo.png')}}" alt="" height="122" class="logo logo-dark">
                                <img src="{{asset('admin/assets/images/logo.png')}}" alt="" height="122" class="logo logo-light">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center">
                    
                    <div class="col-md-8 col-lg-6 col-xl-5">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                    <strong>{{session()->get('message')}}</strong> 
                    </div>
                    @endif
                        <div class="card">
                           
                            <div class="card-body p-4"> 
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome !</h5>
                                    
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="{{route('userlogin')}}" method="post">
                                     @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="Enter username" name="email">
                                            @if($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{$errors->first('email')}}</strong>
                                            </span>
                                            @endif
                                        </div>
                
                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="auth-recoverpw.html" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="userpassword">Password</label>
                                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="userpassword" placeholder="Enter password" name="password">
                                            @if($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{$errors->first('password')}}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="mt-3 text-end">
                                            <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Log In</button>
                                        </div>
            
                                       
                                    </form>
                                </div>
            
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <p style="color:#fff">© <script>document.write(new Date().getFullYear())</script> Au2omation.</p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('admin/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- App js -->
        <!-- <script src="assets/js/app.js"></script> -->

    </body>
</html>
