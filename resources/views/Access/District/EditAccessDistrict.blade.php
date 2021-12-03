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
    <h1>Sửa quyền quận</h1>
    @if(session('mes'))
        {{session('mes')}} <br>
    @endif
    <a href="showaccessdistrict">Xem quyền quận</a> <br>
    <form action="editaccessdistrict" method="post">
        @csrf
        <input type="text" name="username"> <br>
        <input type="date" name="start_date"> <br>
        <input type="date" name="end_date"> <br>
        <input type="submit">
    </form>
</body>
</html>