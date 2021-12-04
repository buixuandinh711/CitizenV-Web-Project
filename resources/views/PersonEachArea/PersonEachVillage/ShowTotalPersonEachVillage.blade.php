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
    <h1>Xem tổng dân số từng thôn</h1>
    <a href="showlistpersoneachvillage">Xem danh sách dân số một thôn</a>
    <table>
        <thead>
            <tr>
                <td>village_id</td>
                <td>total</td>
            </tr>
        </thead>
        <tbody>
            @foreach($persontotal as $p)
                <tr>
                    <td>{{$p->village_id}}</td>
                    <td>{{$p->person_total}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>