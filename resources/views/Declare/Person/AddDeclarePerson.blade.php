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
    <h1>Thêm khai báo dân số</h1>
    <a href="ShowDeclarePerson">Xem khai báo dân số</a> <br>
    <form action="AddDeclarePerson" method="post">
        @csrf
        <input type="text" name="person_id"><br>
        <input type="text" name="person_name"><br>
        <input type="date" name="person_date"><br>
        <input type="text" name="person_gender"><br>
        <input type="submit">
    </form>
    @if(session('mes'))
        {{session('mes')}}
     @endif
</body>
</html>