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
    <h1>Khai báo quận</h1>
    <a href="adddeclaredistrict">Thêm khai báo quận</a><br>
    <a href="editdeclaredistrict">Sửa khai báo quận</a> <br>
    @if(session('mes'))
        {{session('mes')}}<br>
    @endif
    <table>
        <thead>
            <tr>
                <td>district_id</td>
                <td>district_name</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($district as $d)
                <tr>
                    <td>{{$d->district_id}}</td>
                    <td>{{$d->district_name}}</td>
                    <td><a href="deletedeclaredistrict/{{ $d->district_id }}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>