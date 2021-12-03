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
    <h1>Xem khai báo thôn</h1>
    <a href="adddeclarevillage">Thêm khai báo thôn</a><br>
    <a href="editdeclarevillage">Sửa khai báo thôn</a> <br>
    @if(session('mes'))
        {{session('mes')}}<br>
    @endif
    <table>
        <thead>
            <tr>
                <td>village_id</td>
                <td>village_name</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($village as $v)
                <tr>
                    <td>{{$v->village_id}}</td>
                    <td>{{$v->village_name}}</td>
                    <td><a href="deletedeclarevillage/{{ $v->village_id }}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>