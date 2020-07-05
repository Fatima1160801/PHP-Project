<!doctype html>
<html lang="en">
<head>
    <title>PME :: Project Management Evaluation</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

<!--     Fonts and icons     -->
{{--<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>--}}
{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>--}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/materialicon.css')}}"/>
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}"/>


{{--//   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet">--}}
<!-- Material Dashboard CSS -->

<link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css')}}">

<link rel="stylesheet" href="{{ asset('fonts/fonts.css')}}">
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
@yield('css')
</head>
<body>

              @yield('content')



@yield('js')



<script>


{{--function showMessage() {--}}
{{--var $array ="";--}}
{{--$array  = '{{$array}}';--}}
{{--console.log($array);--}}
{{--if ($array) {--}}
{{--myNotify('done', title , 'success', '5000', session);--}}
{{--}--}}



</script>


@yield('script')

</body>
</html>