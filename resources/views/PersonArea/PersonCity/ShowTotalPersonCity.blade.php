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
    <a href="showlistpersoncity">Xem danh sách dân số trong thành phố</a>
    <h1>Tổng dân số trong thành phố là : {{$total}}</h1>
</body>
</html>