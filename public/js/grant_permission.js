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
        setInputError("Thông tin không được để trống!");
        return;
    }

    let currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0);
   
    if (parseDate(startDate) < currentDate) {
        setInputError("Ngày bắt đầu nhỏ hơn thời điểm hiện tại!");
        return;
    }

    if (parseDate(startDate) > parseDate(endDate)) {
        setInputError("Ngày bắt đầu lớn hơn ngày kết thúc!");
        return;
    }

    setInputError("");

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
        $(".display-content").append(grantedPermissionContainer);
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
        

        let handlerCell = $('<td class="table-cell handler-cell">');
        let handlerContainer = $('<div class="handler-container">');
        handlerContainer.append('<span class="modify-delete">Xóa</span>');
        handlerCell.append(handlerContainer);
        tableRow.append(handlerCell);

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
    setInputError("");
})

$("body").on("click", ".modify-delete", function() {
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

function setInputError(err) {

    let errorHint = $("#grant-permission-error");

    if (err.length == 0) {
        errorHint.html("not error");
        errorHint.css("visibility", "hidden");
        return;
    }

    errorHint.html(err);
    errorHint.css("visibility", "visible");
}