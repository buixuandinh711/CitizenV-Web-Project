<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home page</title>
    <link rel="StyleSheet" href="css/home_styles.css">
    <link rel="StyleSheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <script src="js/home.js" defer></script>
    <script src="js/test.js" defer></script>
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
                <span class="sidebar-nav">Khai báo dân số</span>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="management-dropdown">
                <a class="sidebar-nav" id="declare-location-nav" href='add-citizen'>Nhập phiếu điều tra</a>
            </div>
        </aside>
        <div class="content-container">

        </div>
    </div>
</body>

</html>