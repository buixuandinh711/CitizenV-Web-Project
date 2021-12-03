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
    <h1>Tài khoản thôn</h1>
    <a href="adduservillage">Thêm tài khoản thôn</a><br>
    <a href="edituservillage">Sửa tài khoản thôn</a> <br>
    @if(session('mes'))
        {{session('mes')}}<br>
    @endif
    <table>
        <thead>
            <tr>
                <td>username</td>
                <td>password</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $u)
                <tr>
                    <td>{{$u->username}}</td>
                    <td>{{$u->password}}</td>
                    <td><a href="deleteuservillage/{{ $u->username }}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>