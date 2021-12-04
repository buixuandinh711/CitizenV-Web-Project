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
    <a href="showlistpersondistrict">Xem danh sách dân số trong quận</a>
    <h1>Tổng dân số trong quận là : {{$total}}</h1>
</body>
</html>