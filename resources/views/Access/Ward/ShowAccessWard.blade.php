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
    <h1>Quyền phường</h1>
    <a href="AddAccessWard">Thêm quyền phường</a><br>
    <a href="EditAccessWard">Sửa quyền phường</a> <br>
    @if(session('mes'))
        {{session('mes')}}<br>
    @endif
    <table>
        <thead>
            <tr>
                <td>username</td>
                <td>start_date</td>
                <td>end_date</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($access as $a)
                <tr>
                    <td>{{$a->username}}</td>
                    <td>{{$a->start_date}}</td>
                    <td>{{$a->end_date}}</td>
                    <td><a href="DeleteAccessWard/{{ $a->username }}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>