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
    <h1>Sửa quyền thành phố</h1>
    @if(session('mes'))
        {{session('mes')}} <br>
    @endif
    <a href="ShowAccessCity">Xem quyền thành phố</a> <br>
    <form action="EditAccessCity" method="post">
        @csrf
        <input type="text" name="username"> <br>
        <input type="date" name="start_date"> <br>
        <input type="date" name="end_date"> <br>
        <input type="submit">
    </form>
</body>
</html>