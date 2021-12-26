<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home page</title>
    <link rel="StyleSheet" href="css/home_styles.css">
    <link rel="StyleSheet" href="css/general.css">
    <link rel="StyleSheet" href="css/add_citizen.css">
    <link rel="StyleSheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <script src="js/home.js" defer></script>
    <script src="js/check_permission.js" defer></script>
    <script src="js/add_citizen.js" defer></script>
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
                    <a>Thông tin tài khoản</a>
                    <a href='logout'>Đăng xuất</a>
                </div>
            </div>
        </header>
        <aside class="sidebar">
            <div class="sidebar-row" id="declaration">
                <span class="sidebar-nav">Khai báo dân số</span>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="declaration-dropdown">
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
            <h2 class="content-title">Nhập liệu dân số</h2>
            <div class="display-content">
                <div class="wrapper">
                    <div class="add-citizen-container">
                        <div class="add-citizen-row">
                            <label for="add-citizen-id" class="input-label">Mã số định danh cá nhân</label>
                            <input id="add-citizen-id" type="text" class="input-item border-input-item add-citizen-input">
                        </div>
                        <div class="add-citizen-row">
                            <label for="add-citizen-name" class="input-label">Họ và tên</label>
                            <input id="add-citizen-name" type="text" class="input-item border-input-item add-citizen-input">
                        </div>
                        <div class="add-citizen-row">
                            <div class="add-citizen-row-container ">
                                <div class="gender-container">
                                    <label for="add-citizen-gender" class="input-label">Giới tính</label>
                                    <select id="add-citizen-gender" class="input-item border-input-item">
                                        <option disabled="disabled" selected>Giới tính</option>
                                        <option>Nam</option>
                                        <option>Nữ</option>
                                    </select>
                                </div>
                                <div class="date-container">
                                    <label for="add-citizen-dateofbirth" class="input-label">Ngày sinh</label>
                                    <input id="add-citizen-dateofbirth" type="date" class="input-item border-input-item">
                                </div>
                            </div>
                        </div>
                        <div class="add-citizen-row">
                            <label class="input-label">Địa chỉ thường trú</label>
                            <div class="add-citizen-row-container">
                                <input id="add-citizen-permcity" type="text" class="input-item border-input-item add-citizen-select" disabled>
                                <input id="add-citizen-permdistrict" type="text" class="input-item border-input-item add-citizen-select" disabled>
                                <input id="add-citizen-permward" type="text" class="input-item border-input-item add-citizen-select" disabled>
                                <input id="add-citizen-permvillage" type="text" class="input-item border-input-item add-citizen-select" disabled>
                            </div>
                        </div>
                        <div class="add-citizen-row">
                            <label class="input-label">Nơi ở hiện tại</label>
                            <div class="add-citizen-row-container">
                                <select id="add-citizen-curcity" type="text" class="input-item border-input-item add-citizen-select">
                                    <option disabled="disabled" selected>Tỉnh, Thành phố</option>
                                </select>
                                <select id="add-citizen-curdistrict" type="text" class="input-item border-input-item add-citizen-select">
                                    <option disabled="disabled" selected>Quận, Huyện</option>
                                </select>
                                <select id="add-citizen-curward" type="text" class="input-item border-input-item add-citizen-select">
                                    <option disabled="disabled" selected>Xã, Phường</option>
                                </select>
                                <select id="add-citizen-curvillage" type="text" class="input-item border-input-item add-citizen-select">
                                    <option disabled="disabled" selected>Thôn, Tổ dân phố</option>
                                </select>
                            </div>
                        </div>
                        <div class="add-citizen-row">
                            <label for="add-citizen-religion" class="input-label">Tôn giáo</label>
                            <input id="add-citizen-religion" type="text" class="input-item border-input-item add-citizen-input">
                        </div>
                        <div class="add-citizen-row">
                            <div class="add-citizen-row-container">
                                <div class="grade-container">
                                    <label for="add-citizen-grade" class="input-label">Trình độ văn hóa</label>
                                    <input id="add-citizen-grade" type="text" class="input-item border-input-item">
                                </div>
                                <div class="job-container">
                                    <label for="add-citizen-job" class="input-label">Nghề nghiệp</label>
                                    <input id="add-citizen-job" type="text" class="input-item border-input-item">
                                </div>
                            </div>
                        </div>
                        <div class="error-hint" id="add-citizen-error">This is an error</div>
                        <div class="add-citizen-button-row">
                            <div class="add-citizen-row-container">
                                <button class="input-item confirm-button half-button" id="add-citizen-submit">Xác nhận</button>
                                <button class="input-item cancel-button half-button" id="add-citizen-cancel">Hủy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="subtitle non-permission-title">Quyền khai báo chưa được cấp!</h2>
        </div>
    </div>
</body>

</html>