<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icon_univ_bsi.png') }}"/>
    <title>tokoonline</title>
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">
    </head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                
                <div id="loginform">
                    <div style="text-align: center; margin-bottom: 25px; margin-top: 10px;">
    <img src="data:image/png;base64,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" alt="Logo UBSI" style="max-width: 160px; height: auto; display: inline-block;">
</div> 
                    @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>{{ session('error')}} </strong>
                    </div>
                    @endif
                    <form class="form-horizontal m-t-20" action="{{ route('backend.login') }}" method="post">
                        @csrf
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" name="email" value="{{old('email')}}" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Masukkan Email" aria-label="Username" aria-describedby="basic-addon1">
                                    @error('email')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Masukkan Password" aria-label="Password" aria-describedby="basic-addon1">
                                    @error('password')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Lost password?</button>
                                        <button class="btn btn-success float-right" type="submit">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div id="recoverform" style="display: none;">
                    <div class="text-center">
                        <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                    </div>
                    <div class="row m-t-20">
                        <form class="col-12" action="">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon3"><i class="ti-email"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="row m-t-20 p-t-20 border-top border-secondary">
                                <div class="col-12">
                                    <button class="btn btn-success" type="button" id="to-login">Back To Login</button>
                                    <button class="btn btn-info float-right" type="button">Recover</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        
        // ============================================================== 
        // Login and Recover Password Toggle
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function() {
            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });
    </script>

</body>
</html>