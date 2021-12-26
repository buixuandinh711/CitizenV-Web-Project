loadInfo();
clearInputAccount();

function init() {
    $("#management-dropdown").css("display", "block");
    $("#declare-account-nav").css("color", "deepskyblue");
}

init();

var containCode = $(".username").html() === "admin" ? "" : $(".username").html();
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
        $(".content-title").text("Cấp tài khoản cho địa phương thuộc địa bàn " + data.name);
        declaredLocation = data.accountLocation;
        nonAccountLocation = data.noAccountLocation;
        createSelectLocationOptionAccount(nonAccountLocation);
        createAccountTable(declaredLocation);
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
    $("#add-account-username").val(containCode + locationCode);
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
            declaredLocation.push({code : _username, name : getName(_username, nonAccountLocation)});
            nonAccountLocation = nonAccountLocation.filter(item => item.code != _username);
            createSelectLocationOptionAccount(nonAccountLocation);
            createAccountTable(declaredLocation);
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

function getName(code, list) {
    for (const item of list) {
        if (item.code == code) {
            return item.name;
        }
    }
    return "";
}

function postDeleteRequest(_code) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    let location = { username: _code };
    fetch('delete-account', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify(location)
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp == "success") {
            nonAccountLocation.push({code : _code, name : getName(_code, declaredLocation)});
            declaredLocation = declaredLocation.filter(item => item.code != _code);
            createAccountTable(declaredLocation);
            createSelectLocationOptionAccount(nonAccountLocation)

            $.toast({
                heading: 'Xóa địa phương thành công!',
                hideAfter: 1000,
                bgColor: '#00bfff',
                textColor: '#fff',
                loaderBg: '#fff'
            });
        } else {
            $.toast({
                heading: 'Xóa địa phương thất bại!',
                hideAfter: 1000,
                bgColor: '#ff0000',
                textColor: '#fff',
                loaderBg: '#fff'
            });
        }
    });
}

$("body").on("click", "#submit-account-button", function () {
   
    let password = $("#add-account-password").val().trim();
    let repassword = $("#add-account-repassword").val().trim();

   if (!$("#account-location-select").val()) {
       setInputError("Chưa chọn địa phương!")
       return;
   }

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

$("body").on("click", ".modify-delete", function() {
    let $codeCell = $(this).parent().parent().parent().children(':first-child');
    let code = $codeCell.html().substring(containCode.length);
    postDeleteRequest(code);
})

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

function createAccountTable(accountList) {

    if ($(".account-table-container").length == 0 && accountList.length != 0) {
        let container = $('<div class="account-table-container">');
        container.append('<h2>Tài khoản đã cấp</h2>');

        let table = $('<table class="data-table" id="account-table">');
        let tableHeader = $('<thead>');
        let headerRow = $('<tr>');

        headerRow.append('<th class="table-cell table-header">Tên tài khoản</th>');
        headerRow.append('<th class="table-cell table-header">Địa phương quản lý</th>');
        headerRow.append('<th class="table-cell table-header header-icon">Thao tác</th>');

        tableHeader.append(headerRow);
        table.append(tableHeader);
        table.append('<tbody>');
        container.append(table);
        $(".display-content").append(container);
    }

    if (accountList.length == 0) {
        $(".account-table-container").remove();
        return;
    }

    let $tableBody = $("#account-table tbody");
    $tableBody.empty();


    for (const account of accountList) {
        let tableRow = $('<tr>');
        tableRow.append('<td class="table-cell">' + containCode + account.code + '</td>')
        tableRow.append('<td class="table-cell">' + account.name + '</td>')

        let handlerCell = $('<td class="table-cell handler-cell">');
        let handlerContainer = $('<div class="handler-container">');
        handlerContainer.append('<span class="modify-delete">Xóa</span>');
        handlerCell.append(handlerContainer);
        tableRow.append(handlerCell);

        $tableBody.append(tableRow);
    }

}
