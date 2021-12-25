loadInfo();
clearInputAccount();

function init() {
    $("#management-dropdown").css("display", "block");
    $("#declare-account-nav").css("color", "deepskyblue");
}

init();

var containLocation = { code: "01", name: "" };
var declaredLocation = [];
var nonAccountLocation = [];

function loadInfo() {
    fetch('account-location-info', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        containLocation = { code: data.code == "admin" ? "" : data.code, name: data.name };
        $(".content-title").text("Cấp tài khoản cho địa phương thuộc địa bàn " + data.name);
        declaredLocation = data.accountLocation;
        nonAccountLocation = data.noAccountLocation;
        createSelectLocationOptionAccount(nonAccountLocation);
    });
}
function createSelectLocationOptionAccount(locationList) {

    let $locationSelector = $('#account-location-select');

    for (i = 0; i < locationList.length; i++) {
        let location = locationList[i].code + " - " + locationList[i].name;
        let locationOption = $('<option value="' + locationList[i].code + '">' + location + '</option>');
        $locationSelector.append(locationOption)
    }
    selectLocation();
}
$("body").on("change", "#account-location-select", selectLocation);
function selectLocation() {
    setInputError("");
    let locationCode = $("#account-location-select").val();
    if (!locationCode) {
        return;
    }
    $("#add-account-username").val(containLocation.code + locationCode);
}
$("body").on("change", "#add-account-password, #add-account-repassword", function() {
    setInputError("");
});
function submitNewAccount(_username, _password) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    let account = { username: _username, password: _password };
    fetch('add-new-user', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify(account)
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp == "success") {
            clearInputAccount();
            nonAccountLocation = nonAccountLocation.filter(item => item.code != _username);
            createSelectLocationOptionAccount(nonAccountLocation);
            $.toast({
                heading: 'Cấp tài khoản thành công',
                hideAfter: 1000,
                bgColor: '#00bfff',
                textColor: '#fff',
                loaderBg: '#fff'
            });
        }
    });
}

$("body").on("click", "#submit-account-button", function () {

    let password = $("#add-account-password").val().trim();
    let repassword = $("#add-account-repassword").val().trim();
    if (password.length == 0 || repassword.length == 0) {
        setInputError("Mật khẩu không được để trống!");
        return;
    }
    if (!password.match(/^[0-9a-bA-B]\w{1,19}$/) || !repassword.match(/^[0-9a-bA-B]\w{1,19}$/)) {
        setInputError("Mật khẩu sai định dạng!");
        return;
    }
    if (password != repassword) {
        setInputError("Nhập lại mật khẩu không khớp!");
        return;
    }
    setInputError("");
    let username = $("#account-location-select").val();
    submitNewAccount(username, password);
});

$("body").on("click", "#cancel-account-button", function () {
    clearInputAccount();
});
function clearInputAccount() {
    $("#add-account-password").val("");
    $("#add-account-repassword").val("");
    let $locationSelector = $("#account-location-select");
    $locationSelector.empty();
    $locationSelector.append('<option disabled="disabled" selected>Chọn địa phương</option>')
    $('#add-account-username').val("");
}

function setInputError(err) {

    let errorHint = $("#add-account-error");

    if (err.length == 0) {
        errorHint.html("not error");
        errorHint.css("visibility", "hidden");
        return;
    }

    errorHint.html(err);
    errorHint.css("visibility", "visible");
}