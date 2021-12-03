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
    <h1>Khai báo thành phố</h1>
    <a href="adddeclarecity">Thêm khai báo thành phố</a><br>
    <a href="editdeclarecity">Sửa khai báo thành phố</a> <br>
    @if(session('mes'))
        {{session('mes')}}<br>
    @endif
    <table>
        <thead>
            <tr>
                <td>city_id</td>
                <td>city_name</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($city as $c)
                <tr>
                    <td>{{$c->city_id}}</td>
                    <td>{{$c->city_name}}</td>
                    <td><a href="deletedeclarecity/{{ $c->city_id }}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>