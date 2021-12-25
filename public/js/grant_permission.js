var $contentContainer = $(".content-container");

$(".content-container").empty();
createGrantPermissionPage();
clearInputPermission()
loadGrantPermissionLocation();
loadGrantedPermission();
init();

var containLocation = {};
var nonGrantedLocations = [];
var grantedPermissions = [];

function init() {
    $("#declaration-dropdown").css("display", "block");
    $("#grant-declare-permission").css("color", "deepskyblue");
}

function createGrantPermissionPage() {
    $contentContainer.append('<h2 class="content-title">Cấp quyền khai báo</h2>');
    let addPermissionContainer = $('<div class="add-permission-container">');
    addPermissionContainer.append('<h2>Thêm quyền khai báo mới</h2>');

    permissionInputContaienr = $('<div class="permission-input-container">');
    
    let div1 = $('<div>');
    div1.append('<div>Chọn địa phương</div>');
    div1.append('<select class="input-item border-input-item" id="permission-location-select">');
    permissionInputContaienr.append(div1);

    let div2 = $('<div>');
    div2.append('<div>Ngày bắt đầu</div>');
    div2.append('<input type="date" class="input-item border-input-item" id="permission-start-date">');
    permissionInputContaienr.append(div2);

    let div3 = $('<div>');
    div3.append('<div>Ngày kết thúc</div>');
    div3.append('<input type="date" class="input-item border-input-item" id="permission-end-date">');
    permissionInputContaienr.append(div3);

    let div4 = $('<div>');
    div4.append('<button class="input-item confirm-button button-item" id="submit-permission">Xác nhận</button>');
    permissionInputContaienr.append(div4);

    let div5 = $('<div>');
    div5.append('<button class="input-item cancel-button button-item" id="cancel-permission">Hủy</button>');
    permissionInputContaienr.append(div5);

    addPermissionContainer.append(permissionInputContaienr);
    addPermissionContainer.append('<div class="error-hint" id="grant-permission-error"></div>')
    $contentContainer.append(addPermissionContainer);
} 

$("body").on("click", "#submit-permission", function() {
    let selectedLocationCode = $("#permission-location-select").val();
    let selectedLocationName = "";
    for (const location of nonGrantedLocations) {
        if (location.code == selectedLocationCode) {
            selectedLocationName = location.name;
        }
    }
    let startDate = $("#permission-start-date").val();
    let endDate = $("#permission-end-date").val();

    let $errorHint = $('#grant-permission-error');

    if (!selectedLocationCode || startDate.length == 0 || endDate.length == 0) {
        $errorHint.html("Thông tin không được để trống!");
        return;
    }

    let currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0);
   
    if (parseDate(startDate) < currentDate) {
        $errorHint.html("Ngày bắt đầu nhỏ hơn thời điểm hiện tại!");
        return;
    }

    if (parseDate(startDate) > parseDate(endDate)) {
        $errorHint.html("Ngày bắt đầu lớn hơn ngày kết thúc!");
        return;
    }

    submitNewPermission(selectedLocationCode, selectedLocationName, startDate, endDate);
})

function createGrantedPermissionTable(grantedList) {

    if ($(".granted-permission").length == 0 && grantedList.length != 0) {
        let grantedPermissionContainer = $('<div class="granted-permission">');
        grantedPermissionContainer.append('<h2>Quyền khai báo đã cấp</h2>');

        let grantedTable = $('<table class="data-table" id="granted-permission-table">');
        let tableHeader = $('<thead>');
        let headerRow = $('<tr>');

        headerRow.append('<th class="table-cell table-header">Mã địa phương</th>');
        headerRow.append('<th class="table-cell table-header">Tên địa phương</th>');
        headerRow.append('<th class="table-cell table-header">Ngày bắt đầu</th>');
        headerRow.append('<th class="table-cell table-header">Ngày kết thúc</th>');
        headerRow.append('<th class="table-cell table-header header-icon">Thao tác</th>');

        tableHeader.append(headerRow);
        grantedTable.append(tableHeader);
        grantedTable.append('<tbody>');
        grantedPermissionContainer.append(grantedTable);
        $contentContainer.append(grantedPermissionContainer);
    }

    if (grantedList.length == 0) {
        $(".granted-permission").remove();
        return;
    }

    let $tableBody = $("#granted-permission-table tbody");
    $tableBody.empty();

    for (i = 0; i < grantedList.length; i++) {
        let grantedPermission = grantedList[i];
        let tableRow = $('<tr>');
        tableRow.append('<td class="table-cell">' + grantedPermission.user + '</td>')
        tableRow.append('<td class="table-cell">' + grantedPermission.location + '</td>')
        tableRow.append('<td class="table-cell">' + grantedPermission.startDate + '</td>')
        tableRow.append('<td class="table-cell">' + grantedPermission.endDate + '</td>')
        
        let iconCell = $('<td class="table-cell icon-cell">');
        let iconContainer = $('<div class="icon-container">');
       //iconContainer.append('<span class="table-icon edit-icon"></span>');
        iconContainer.append('<span class="table-icon remove-icon delete-permission-button"></span>');
        iconCell.append(iconContainer);
        tableRow.append(iconCell);

        $tableBody.append(tableRow);
    }

}

function loadGrantedPermission() {
    fetch('load-declared-permission', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        grantedPermissions = data.info
        createGrantedPermissionTable(grantedPermissions);
    });
}

function loadGrantPermissionLocation() {
    fetch('declare-permission-location-info', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        $(".content-title").text("Cấp quyền khai báo cho địa phương thuộc địa bàn " + data.name);
        containLocation = {code : data.code == "admin" ? "" : data.code, name : data.name};
        nonGrantedLocations = data.nonGrantedLocation;
        createSelectLocationOptionPermission(nonGrantedLocations);
    });
}

function submitNewPermission(_code, _name, _startDate, _endDate) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    let permission = { code: _code, startDate: _startDate, endDate : _endDate };
    fetch('submit-declared-permission', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify(permission)
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp == "success") {
            
            clearInputPermission();
            grantedPermissions.push({location : _name, user : containLocation.code + _code, startDate : _startDate, endDate : _endDate});
            createGrantedPermissionTable(grantedPermissions);
            nonGrantedLocations = nonGrantedLocations.filter(item => item.code !== _code);
            createSelectLocationOptionPermission(nonGrantedLocations);
            $.toast({
                heading: 'Cấp quyền khai báo thành công!',
                hideAfter: 1000,
                bgColor: '#00bfff',
                textColor: '#fff',
                loaderBg: '#fff'
            });

        }
    });
}

function postDeletePermission(_code, _name) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    fetch('delete-permission', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({code : _code})
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp == "success") {
            
            grantedPermissions = grantedPermissions.filter(item => item.user !== containLocation.code + _code);
            createGrantedPermissionTable(grantedPermissions);
            nonGrantedLocations.push({code : _code, name : _name});
            createSelectLocationOptionPermission(nonGrantedLocations);

            $.toast({
                heading: 'Thu hồi quyền khai báo thành công!',
                hideAfter: 1000,
                bgColor: '#00bfff',
                textColor: '#fff',
                loaderBg: '#fff'
            });

        }
    });
}

function createSelectLocationOptionPermission(locationList) {

    let $locationSelector = $('#permission-location-select');
    $locationSelector.empty();
    $locationSelector.append('<option disabled="disabled" selected value="">Chọn địa phương</option>');

    for (i = 0; i < locationList.length; i++) {
        let location = locationList[i].code + " - " + locationList[i].name;
        let locationOption = $('<option value="' + locationList[i].code + '">' + location + '</option>');
        $locationSelector.append(locationOption)
    }
    
}

function clearInputPermission() {
    $("#permission-location-select").empty();
    $("#permission-start-date").val("");
    $("#permission-end-date").val("");
}

$("body").on("change", "#permission-location-select, #permission-start-date, #permission-end-date", function() {
    $('#grant-permission-error').html("");
})

$("body").on("click", ".delete-permission-button", function() {
    let $codeCell = $(this).parent().parent().parent().children(':first-child');
    let code = $codeCell.html().substring(containLocation.code.length);
    let name = $codeCell.next().html();
    postDeletePermission(code, name);
})
function postDeletePermission(_code, _name) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    fetch('delete-permission', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({code : _code})
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp == "success") {
            
            grantedPermissions = grantedPermissions.filter(item => item.user !== containLocation.code + _code);
            createGrantedPermissionTable(grantedPermissions);
            nonGrantedLocations.push({code : _code, name : _name});
            createSelectLocationOptionPermission(nonGrantedLocations);

            $.toast({
                heading: 'Thu hồi quyền khai báo thành công!',
                hideAfter: 1000,
                bgColor: '#00bfff',
                textColor: '#fff',
                loaderBg: '#fff'
            });

        }
    });
}

