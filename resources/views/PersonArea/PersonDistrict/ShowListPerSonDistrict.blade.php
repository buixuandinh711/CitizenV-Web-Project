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
    <h1>{{session('user')->username}}</h1>
    <h1>Xem danh sách dân số trong quận</h1>
    <a href="showinfopersondistrict">Xem thông tin một người trong quận</a> <br>
    <a href="showtotalpersondistrict">Xem tổng dân số trong quận</a> <br>
    <table>
        <thead>
            <tr>
                <td>person_id</td>
                <td>person_name</td>
            </tr>
        </thead>
        <tbody>
            @foreach($person as $p)
                <tr>
                    <td>{{$p->person_id}}</td>
                    <td>{{$p->person_name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>