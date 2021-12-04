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
    <a href="showlistpersondistrict">Xem danh sách dân số trong quận</a>
    <h1>Xem Thông Tin Một người trong quận</h1>
    <form action="showinfopersondistrict" method="post">
        @csrf
        <input type="text" name="person_id"> <br>
        <input type="submit">
    </form>
    @if(isset($person))
        <table>
            <thead>
                <tr>
                    <th>person_id</th>
                    <th>person_name</th>
                    <th>person_date</th>
                    <th>person_gender</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $person->person_id }}</td>
                    <td>{{ $person->person_name }}</td>
                    <td>{{ $person->person_date }}</td>
                    <td>{{ $person->person_gender }}</td>
                </tr>
            </tbody>
        </table>
    @endif
</body>
</html>