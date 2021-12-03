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
    <h1>{{session('user')->username}}</h1>
    <h1>Thêm khai báo phường</h1>
    <a href="showdeclareward">Xem khai báo phường</a> <br>
    <form action="adddeclareward" method="post">
        @csrf
        <input type="text" name="ward_id"><br>
        <input type="text" name="ward_name"><br>
        <input type="submit">
    </form>
    @if(session('mes'))
        {{session('mes')}}
     @endif
</body>
</html>