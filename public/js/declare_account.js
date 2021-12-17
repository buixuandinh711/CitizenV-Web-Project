$("#declare-account-nav").click(function() {
    createAddAccountPage();
    clearInput();
    createSelectLocationOption([{code:"01", name: "Ha Noi"}, {code:"02", name:"Ho Chi Minh"}, {code:"03", name:"Hai Duong"}]);
})
function createAddAccountPage() {
    let $contenContainer = $(".content-container");
    $contenContainer.empty();
    $contenContainer.append('<h2 class="content-title">Cấp tài khoản cho Tỉnh/Thành phố</h2>');
    let $addAccountContainer = $('<div class="add-account-container">');

    let $addAccountRow1 = $('<div class="add-account-row">');

    let $div1 = $('<div>');
    $div1.append('<label for="account-location-select" class="input-label">Địa phương</label>');
    $div1.append('<select id="account-location-select" class="input-item border-input-item">');
    $addAccountRow1.append($div1);

    let $div2 = $('<div>');
    $div2.append('<label for="add-account-username" class="input-label">Tài khoản tương ứng</label>');
    $div2.append('<input id="add-account-username" type="text" disabled class="input-item border-input-item" value="010203">');
    $addAccountRow1.append($div2);

    let $passwordDiv = $('<div class="password-container">');
    $passwordDiv.append('<label class="input-label" for="add-account-password">Mật khẩu</label>');
    $passwordDiv.append('<input type="password" class="input-item border-input-item add-account-input" id="add-account-password">');
    $addAccountContainer.append($passwordDiv)

    let $rePasswordDiv = $('<div class="password-container">');
    $rePasswordDiv.append('<label class="input-label" for="add-account-repassword">Nhập lại mật khẩu</label>');
    $rePasswordDiv.append('<input type="password" class="input-item border-input-item add-account-input" id="add-account-repassword">');
    $addAccountContainer.append($rePasswordDiv)

    let $addAccountRow2 = $('<div class="add-account-row">');
    $addAccountRow2.append('<button class="input-item confirm-button add-account-button" id="submit-account-button">Xác nhận</button>');
    $addAccountRow2.append('<button class="input-item cancel-button add-account-button" id="cancel-account-button">Hủy</button>')

    $addAccountContainer.append($addAccountRow1);
    $addAccountContainer.append($passwordDiv);
    $addAccountContainer.append($rePasswordDiv)
    $addAccountContainer.append('<div class="error-hint" id="add-account-error"></div>')
    $addAccountContainer.append($addAccountRow2)

    $contenContainer.append($addAccountContainer);
}

var containLocation = {code:"01", name:""};
var declaredLocation = [];

function loadInfo() {
    fetch('current-local-info', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        $(".content-title").text("Cấp tài khoản cho địa phương thuộc địa bàn " + data.local)
        declaredLocation = data.codes;
    });
}
function createSelectLocationOption(locationList) {
    let $locationSelector = $('#account-location-select');

    for (i = 0; i < locationList.length; i++) {
        let location = locationList[i].code + " - " + locationList[i].name;
        let locationOption = $('<option>' + location + '</option>');
        $locationSelector.append(locationOption)
    }
    selectLocation();
}
$("body").on("change", "#account-location-select", selectLocation);
function selectLocation() {
    let selectVal = $("#account-location-select").val();
    if (!selectVal) {
        return;
    }
    let locationCode = selectVal.substring(0, 2);
    $("#add-account-username").val(containLocation.code + locationCode);
}
$("body").on("click", "#submit-account-button", function() {
    let password = $("#add-account-password").val().trim();
    let repassword = $("#add-account-repassword").val().trim();
    let $errorHint = $("#add-account-error");
    if (password.length == 0 || repassword.length == 0) {
        $errorHint.html("Mật khẩu không được để trống!");
        return;
    }
    if (!password.match(/^[0-9a-bA-B]\w{1,19}$/) || !repassword.match(/^[0-9a-bA-B]\w{1,19}$/)) {
        $errorHint.html("Mật khẩu sai định dạng!");
        return;
    }
    if (password != repassword) {
        $errorHint.html("Nhập lại mật khẩu không khớp!");
        return;
    }
    $errorHint.html("");
    console.log("success");
});

$("body").on("click", "#cancel-account-button", function() {
    console.log(1);
    clearInput();
});
function clearInput() {
    $("#add-account-password").val("");
    $("#add-account-repassword").val("");
    let $locationSelector = $("#account-location-select");
    $locationSelector.empty();
    $locationSelector.append('<option disabled="disabled" selected>Chọn địa phương</option>')
    $('#add-account-username').val("");
}