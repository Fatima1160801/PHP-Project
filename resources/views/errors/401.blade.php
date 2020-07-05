<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        PME
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/material-dashboard.css?v=2.0.2')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets/demo/demo.css')}}" rel="stylesheet" />
</head>

<body class="off-canvas-sidebar">

<!-- End Navbar -->
<div class="wrapper wrapper-full-page">
    <div class="page-header register-page header-filter" filter-color="black" style="background-image: url('{{ asset('assets/img/login.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto">
                    <div class="card card-signup">
                        <h4 class="card-title text-center">
                            <div class="icon icon-rose">
                                <i class="material-icons" style="font-size: 75px;">error</i>
                            </div> You don’t have permissions to view this page Please contact your administration!
                            <br>
{{--                            {{url(request()->headers->get('referer'))}}--}}
                            <a href="" class="btn btn-rose mt-5">
                                <i class="material-icons">settings_backup_restore</i> Back
                            </a>

                            <a href="{{url('login')}}" class="btn btn-rose mt-5">
                                <i class="material-icons">home</i> Home
                            </a>

                        </h4>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 ml-auto m-auto">
                                    <div class="row">
                                        <div class="col-md-10">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--   Core JS Files   -->


</body>

</html>