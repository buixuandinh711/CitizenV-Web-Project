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
    <h1>Khai báo phường</h1>
    <a href="AddDeclareWard">Thêm khai báo phường</a><br>
    <a href="EditDeclareWard">Sửa khai báo phường</a> <br>
    @if(session('mes'))
        {{session('mes')}}<br>
    @endif
    <table>
        <thead>
            <tr>
                <td>ward_id</td>
                <td>ward_name</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($ward as $w)
                <tr>
                    <td>{{$w->ward_id}}</td>
                    <td>{{$w->ward_name}}</td>
                    <td><a href="DeleteDeclareWard/{{ $w->ward_id }}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>