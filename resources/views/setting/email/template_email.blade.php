<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>fprojects Mail system</title>
</head>
<body>
<h4>Dear Mr./Mrs. {{$to_name ?? ""}}</h4>

<p>{!!$body ?? ""!!}</p>
<br>
<h5>Best Regards</h5>
<h5>PARC</h5>
<img src="http://fprojects.ps/project/images/user/photo/1589978097.png" width="30px" height="30px" alt="logo">
</body>
</html>


