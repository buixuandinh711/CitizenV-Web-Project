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
    <h1>Sửa khai báo phường</h1>
    @if(session('mes'))
        {{session('mes')}} <br>
    @endif
    <a href="ShowDeclareWard">Xem khai báo phường</a> <br>
    <form action="EditDeclareWard" method="post">
        @csrf
        <input type="text" name="ward_id"> <br>
        <input type="text" name="ward_name"> <br>
        <input type="submit">
    </form>
</body>
</html>