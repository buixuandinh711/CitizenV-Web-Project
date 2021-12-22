<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home page</title>
    <link rel="StyleSheet" href="css/home_styles.css">
    <link rel="StyleSheet" href="css/general.css">
    <link rel="StyleSheet" href="css/grant_permission.css">
    <link rel="StyleSheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <script src="js/home.js" defer></script>
    <script src="js/grant_permission.js" defer></script>
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
                            <a>Thông tin tài khoản</a>
                            <a href="logout">Đăng xuất</a>
                        </div>
                    </div>
        </header>
        <aside>
            <div class="sidebar-row" id="management">
                <span class="sidebar-nav">Quản lý địa phương</span>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="management-dropdown">
                <a class="sidebar-nav" id="declare-location-nav" href='declare-location'>Khai báo địa phương</a>
                <a class="sidebar-nav" id="declare-account-nav" href='declare-account'>Cấp tài khoản</a>
            </div>
            <div class="sidebar-row" id="declaration">
                <span class="sidebar-nav">Khai báo dân sô</span>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="declaration-dropdown">
                <a class="sidebar-nav" id="grant-declare-permission" href='grant-permission'>Cấp quyền khai báo</a>
                <a class="sidebar-nav" href='declare-status'>Theo dõi tiến độ</a>
            </div>
            <div class="sidebar-row" id="information">
                <span class="sidebar-nav">Thông tin dân số</span>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="information-dropdown">
                <a class="sidebar-nav">Số liệu dân số</a>
                <a class="sidebar-nav" href='list-citizen'>Danh sách dân số</a>
            </div>
        </aside>
        <div class="content-container">

        </div>
    </div>
</body>

</html>