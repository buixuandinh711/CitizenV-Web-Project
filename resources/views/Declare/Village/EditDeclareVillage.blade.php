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
    <h1>Sửa khai báo thôn</h1>
    @if(session('mes'))
        {{session('mes')}} <br>
    @endif
    <a href="showdeclarevillage">Xem khai báo thôn</a> <br>
    <form action="editdeclarevillage" method="post">
        @csrf
        <input type="text" name="village_id"> <br>
        <input type="text" name="village_name"> <br>
        <input type="submit">
    </form>
</body>
</html>