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
    <h1>Xem danh sách dân số một thôn</h1>
    <a href="showtotalpersoneachvillage">Xem dân số từng thôn</a>
    <form action="showlistpersoneachvillage" method="post">
        @csrf
        <input type="text" name="village_id">
        <input type="submit">
    </form>
    @if(isset($person))
        @if(count($person))
            <table>
                <thead>
                    <tr>
                        <th>person_id</th>
                        <th>person_name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($person as $p)
                        <tr>
                            <td>{{ $p->person_id }}</td>
                           <td>{{ $p->person_name }}</td>
                       </tr>
                   @endforeach
                </tbody>
            </table>
        @endif
    @endif
</body>
</html>