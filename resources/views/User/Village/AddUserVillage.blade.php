<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="Main">Trang chủ</a>
    <h1>{{session('user')->username}}</h1>
    <h1>Thêm tài khoản thôn</h1>
    <a href="ShowUserVillage">Xem tài khoản thôn</a> <br>
    <form action="AddUserVillage" method="post">
        @csrf
        <input type="text" name="username"><br>
        <input type="password" name="password"><br>
        <input type="submit">
    </form>
    @if(session('mes'))
        {{session('mes')}}
     @endif
</body>
</html>