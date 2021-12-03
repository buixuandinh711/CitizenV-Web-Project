<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Xem Thông Tin Một người</h1>
    <input type="text" name="person_id"> <br>
    <input type="submit">
    @if($person)
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
                    <td>{{ $person_id }}</td>
                    <td>{{ $person_name }}</td>
                    <td>{{ $person_date }}</td>
                    <td>{{ $person_gender }}</td>
                </tr>
            </tbody>
        </table>
    @endif
</body>
</html>