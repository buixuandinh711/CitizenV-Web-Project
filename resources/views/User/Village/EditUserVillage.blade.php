<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="main">Trang chủ</a>
    <h1>Sửa tài khoản thôn</h1>
    @if(session('mes'))
        {{session('mes')}} <br>
    @endif
    <a href="showuservillage">Xem tài khoản thôn</a> <br>
    <form action="edituservillage" method="post">
        @csrf
        <input type="text" name="username"> <br>
        <input type="password" name="password"> <br>
        <input type="submit">
    </form>
</body>
</html>