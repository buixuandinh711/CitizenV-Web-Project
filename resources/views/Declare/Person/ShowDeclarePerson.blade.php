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
    <h1>Khai báo dân số</h1>
    <a href="adddeclareperson">Thêm khai báo dân số</a><br>
    <a href="editdeclareperson">Sửa khai báo dân số</a> <br>
    @if(session('mes'))
        {{session('mes')}}<br>
    @endif
    <table>
        <thead>
            <tr>
                <td>person_id</td>
                <td>person_name</td>
                <td>person_date</td>
                <td>person_gender</td>
            </tr>
        </thead>
        <tbody>
            @foreach($person as $p)
                <tr>
                    <td>{{$p->person_id}}</td>
                    <td>{{$p->person_name}}</td>
                    <td>{{$p->person_date}}</td>
                    <td>{{$p->person_gender}}</td>
                    <td><a href="deletedeclareperson/{{ $p->person_id }}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>