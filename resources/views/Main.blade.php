<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="css/Main.css">
</head>
<body>
    <h1>Trang chủ</h1>
    <h1>{{session('user')->username}}</h1>
    <h2>Tài khoản</h2>
    <a href="showusercity">Xem tài khoản thành phố</a> <br>
    <a href="showuserdistrict">Xem tài khoản quận</a> <br>
    <a href="showuserward">Xem tài khoản phường</a> <br>
    <a href="showuservillage">Xem tài khoản thôn</a> <br>
    <h2>Khai báo</h2>
    <a href="showdeclarecity">Xem khai báo thành phố</a> <br>
    <a href="showdeclaredistrict">Xem khai báo quận</a> <br>
    <a href="showdeclareward">Xem khai báo phường</a> <br>
    <a href="showdeclarevillage">Xem khai báo thôn</a> <br>
    <a href="showdeclareperson">Xem khai báo dân số</a> <br>
    <h2>Quyền</h2>
    <a href="showaccesscity">Xem quyền thành phố</a> <br>
    <a href="showaccessdistrict">Xem quyền quận</a> <br>
    <a href="showaccessward">Xem quyền phường</a> <br>
    <a href="showaccessvillage">Xem quyền thôn</a> <br>
    <h2>Xem dân số trong khu vực</h2>
    <a href="">Xem dân số trong nước</a> <br>
    <a href="">Xem dân số trong thành phố</a> <br>
    <a href="">Xem dân số trong quận</a> <br>
    <a href="">Xem dân số trong phường</a> <br>
    <h2>Xem dân số từng khu vực</h2>
    <a href="">Xem dân số từng thành phố</a> <br>
    <a href="">Xem dân số từng quận</a> <br>
    <a href="">Xem dân số trong từng phường</a> <br>
    <a href="">Xem dân số từng thôn</a> <br>
    @if (session('mes'))
        <h2>Lỗi</h2>
        {{session('mes')}} <br>
    @endif
    <h2>Đăng xuất</h2>
    <a href="logout">Logout</a>
</body>
</html>