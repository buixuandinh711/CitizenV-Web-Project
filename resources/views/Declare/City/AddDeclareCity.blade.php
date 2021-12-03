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
    <h1>Thêm khai báo thành phố</h1>
    <a href="ShowDeclareCity">Xem khai báo thành phố</a> <br>
    <form action="AddDeclareCity" method="post">
        @csrf
        <input type="text" name="city_id"><br>
        <input type="text" name="city_name"><br>
        <input type="submit">
    </form>
    @if(session('mes'))
        {{session('mes')}}
     @endif
</body>
</html>