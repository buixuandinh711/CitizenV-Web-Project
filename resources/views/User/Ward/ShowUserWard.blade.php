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
    <h1>Tài khoản phường</h1>
    <a href="AddUserWard">Thêm tài khoản phường</a><br>
    <a href="EditUserWard">Sửa tài khoản phường</a> <br>
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
                    <td><a href="DeleteUserWard/{{ $u->username }}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>