



<!DOCTYPE html>
<html lang="en">

<head>

<link href='https://fonts.googleapis.com/css?family=Anton|Passion+One|PT+Sans+Caption' rel='stylesheet' type='text/css'>
<link href="{{asset('css/errorPage.css')}}" type="text/css" rel='stylesheet'>
</head>
<body>

<!-- Error Page -->
<div class="error">
    <div class="container-floud">
        <div class="col-xs-12 ground-color text-center">
            <div class="container-error-404">
                <div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
                <div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
                <div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
                <div class="msg">OH!<span class="triangle"></span></div>
            </div>
            <h2 class="h1">{{ $massage  or 'Sorry! Page not found '}} </h2>
            <a class="btn btn-primary"  href="{{route('home')}}">
                Go to Home
            </a>
        </div>
    </div>
</div>
<!-- Error Page -->
</body>

<script src="{{asset('js\errorPage.js')}}" type="text/javascript"></script>



</html>

