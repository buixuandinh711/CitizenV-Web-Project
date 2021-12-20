<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="StyleSheet" href="css/home_styles.css">
    <link rel="StyleSheet" href="css/general.css">
    <link rel="StyleSheet" href="css/add_citizen.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/home.js" defer></script>
</head>

<body>
    <div class="container">
        <header>
            <span class="page-logo">Citizen V</span>
            <div class="account-dropdown-container">
                <span class="account-container">
                    <a class="username">Admin</a>
                    <b class="caret" id="account-caret"></b>
                </span>
                <div class="account-dropdown">
                    <a>Thông tin tài khoản</a>
                    <a>Đăng xuất</a>
                </div>
            </div>
        </header>
        <aside>
            <div class="sidebar-row" id="management">
                <span class="sidebar-nav">Quản lý địa phương</span>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="management-dropdown">
                <span class="sidebar-nav" id="declare-location-nav">Khai báo địa phương</span>
                <span class="sidebar-nav" id="declare-account-nav">Cấp tài khoản</span>
            </div>
            <div class="sidebar-row" id="declaration">
                <span class="sidebar-nav">Khai báo dân sô</span>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="declaration-dropdown">
                <span class="sidebar-nav">Cấp quyền khai báo</span>
                <span class="sidebar-nav">Theo dõi tiến độ</span>
            </div>
            <div class="sidebar-row" id="information">
                <span class="sidebar-nav">Thông tin dân số</span>
                <b class="caret sidebar-caret"></b>
            </div>
            <div class="dropdown-container" id="information-dropdown">
                <span class="sidebar-nav">Số liệu dân số</span>
                <span class="sidebar-nav">Danh sách dân số</span>
            </div>
        </aside>
        <div class="content-container">
            <h2 class="content-title">Nhập liệu dân số</h2>
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
                    <div class="add-citizen-row-container add-citizen-row">
                        <div>
                            <label for="add-citizen-gender" class="input-label">Giới tính</label>
                            <select id="add-citizen-gender" class="input-item border-input-item add-citizen-input">
                                <option disabled="disabled" selected>Giới tính</option>
                                <option>Nam</option>
                                <option>Nữ</option>
                            </select>
                        </div>
                        <div>
                            <label for="add-citizen-dateofbirth" class="input-label">Ngày sinh</label>
                            <input id="add-citizen-dateofbirth" type="date" class="input-item border-input-item add-citizen-input">
                        </div>
                    </div>
                    <div class="add-citizen-row">
                        <label class="input-label">Địa chỉ thường trú</label>
                        <div class="add-citizen-row">
                            <select id="add-citizen-permcity" type="text" class="input-item border-input-item add-citizen-select">
                                <option disabled="disabled" selected>Tỉnh, Thành Phố</option>
                            </select>
                            <select id="add-citizen-permdistrict" type="text" class="input-item border-input-item add-citizen-select">
                                <option disabled="disabled" selected>Quận, Huyện</option>
                            </select>
                            <select id="add-citizen-permward" type="text" class="input-item border-input-item add-citizen-select">
                                <option disabled="disabled" selected>Xã, Phường</option>
                            </select>
                            <select id="add-citizen-permvillage" type="text" class="input-item border-input-item add-citizen-select">
                                <option disabled="disabled" selected>Thôn, Tổ dân phố</option>
                            </select>
                        </div>
                    </div>
                    <div class="add-citizen-row">
                        <label class="input-label">Nơi ở hiện tại</label>
                        <div class="add-citizen-row">
                            <select id="add-citizen-curcity" type="text" class="input-item border-input-item add-citizen-select">
                                <option disabled="disabled" selected>Tỉnh, Thành Phố</option>
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
                    <div class="add-citizen-row-container add-citizen-row">
                        <div>
                            <label for="add-citizen-grade" class="input-label">Trình độ văn hóa</label>
                            <input id="add-citizen-grade" type="text" class="input-item border-input-item add-citizen-input">
                        </div>
                        <div>
                            <label for="add-citizen-job" class="input-label">Nghề nghiệp</label>
                            <input id="add-citizen-job" type="text" class="input-item border-input-item add-citizen-input">
                        </div>
                    </div>
                    <div class="error-hint" id="add-citizen-error">This is an error</div>
                    <div class="add-citizen-row-container add-citizen-button-row">
                        <button class="input-item confirm-button" id="add-citizen-submit">Xác nhận</button>
                        <button class="input-item cancel-button" id="add-citizen-cancel">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>