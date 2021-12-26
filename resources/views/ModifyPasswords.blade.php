<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home page</title>
    <link rel="StyleSheet" href="css/home_styles.css">
    <link rel="StyleSheet" href="css/general.css">
    <link rel="StyleSheet" href="css/modify_password.css">
    <link rel="StyleSheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <script src="js/home.js" defer></script>
    <script src="js/modify_password.js" defer></script>
</head>

<body>
    <div class="container">
        <header>
            <div class="menu-title-container">
                <div class="menu-icon">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <a href="main"><span class="page-logo">Citizen V</span></a>
            </div>
            <div class="account-dropdown-container">
                <span class="account-container">
                    <a class="username">{{session('user')->username}}</a>
                    <b class="caret" id="account-caret"></b>
                </span>
                <div class="account-dropdown">
                    <a href="modify-password">Đổi mật khẩu</a>
                    <a href="logout">Đăng xuất</a>
                </div>
            </div>
        </header>
        <aside class="sidebar">
            <div class="sidebar-row" id="management">
                <span class="sidebar-nav">Khai báo dân số</span>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="management-dropdown">
                <a class="sidebar-nav" id="declare-location-nav" href='add-citizen'>Nhập phiếu điều tra</a>
            </div>
            <div class="sidebar-row" id="information">
                <span class="sidebar-nav">Thông tin dân số</span>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="information-dropdown">
                <a class="sidebar-nav" href='list-citizen'>Danh sách dân số</a>
            </div>
        </aside>
        <div class="content-container">
            <h2 class="content-title">Đổi mật khẩu</h2>
            <div class="modify-password-container">
                <div class="old-password-container">
                    <label class="input-label">Mật khẩu hiện tại</label>
                    <input type="password" class="input-item border-input-item" id="old-password">
                </div>
                <div class="password-container">
                    <label class="input-label">Mật khẩu mới</label>
                    <input type="password" class="input-item border-input-item" id="new-password">
                </div>
                <div class="password-container">
                    <label class="input-label">Mật khẩu mới</label>
                    <input type="password" class="input-item border-input-item" id="new-repassword">
                </div>
                <button class="input-item confirm-button" id="submit-password">Đổi mật khẩu</button>
            </div>
            <div class="error-hint" id="modify-password-error">This is an error</div>
        </div>
    </div>
</body>

</html>