<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="StyleSheet" href="css/home_styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/home.js" defer></script>
</head>

<body>
    <div class="container">
        <header>
            <a href="main"><span class="page-logo">Citizen V</span><a>
            <div class="account-dropdown-container">
                <span class="account-container">
                    <a class="username">{{session('user')->username}}</a>
                    <b class="caret" id="account-caret"></b>
                </span>
                <div class="account-dropdown">
                    <a href="showinfouser">Thông tin tài khoản</a>
                    <a href="logout">Đăng xuất</a>
                </div>
            </div>
        </header>
        <aside>
            <div class="sidebar-row" id="management">
                <a class="sidebar-nav">Quản lý địa phương</a>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="management-dropdown">
                <a class="sidebar-nav" href="showdeclare">Khai báo địa phương</a>
                <a class="sidebar-nav" href="showuser">Cấp tài khoản</a>
            </div>
            <div class="sidebar-row" id="declaration">
                <a class="sidebar-nav">Khai báo dân số</a>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="declaration-dropdown">
                <a class="sidebar-nav" href="showaccess">Cấp quyền khai báo</a>
                <a class="sidebar-nav" href="showfollow">Theo dõi tiến độ</a>
            </div>
            <div class="sidebar-row" id="information">
                <a class="sidebar-nav">Thông tin dân số</a>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="information-dropdown">
                <a class="sidebar-nav" href="showtotalpersoneachcity">Tổng hợp dân số từng thành phố</a>
                <a class="sidebar-nav" href="showtotalpersoneachdistrict">Tổng hợp dân số từng quận</a>
                <a class="sidebar-nav" href="showtotalpersoneachward">Tổng hợp dân số từng phường</a>
                <a class="sidebar-nav" href="showtotalpersoneachvillage">Tổng hợp dân số từng thôn</a>
                <a class="sidebar-nav" href="showlistperson">Danh sách dân số</a>
            </div>
        </aside>
        <div class="content-container">
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
        </div>
    </div>
</body>

</html>

<!-- <!DOCTYPE html>
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
</html> -->