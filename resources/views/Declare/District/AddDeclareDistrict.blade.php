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
    <h1>Thêm khai báo quận</h1>
    <a href="ShowDeclareDistrict">Xem khai báo quận</a> <br>
    <form action="AddDeclareDistrict" method="post">
        @csrf
        <input type="text" name="district_id"><br>
        <input type="text" name="district_name"><br>
        <input type="submit">
    </form>
    @if(session('mes'))
        {{session('mes')}}
     @endif
</body>
</html>