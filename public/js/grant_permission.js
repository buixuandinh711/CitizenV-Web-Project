var $contentContainer = $(".content-container");

$('#grant-declare-permission').click(function() {
    $(".content-container").empty();
    createGrantPermissionPage();
    // createGrantedPermissionTable([{location : "Ha Noi", user : "01", startDate : "01/12/2021", endDate : "31/12/2021"}, ]);
    loadGrantedPermission();
})

function createGrantPermissionPage() {
    $contentContainer.append('<h2 class="content-title">Cấp quyền khai báo</h2>');
    let addPermissionContainer = $('<div class="add-permission-container">');
    addPermissionContainer.append('<h2>Thêm quyền khai báo mới</h2>');

    permissionInputContaienr = $('<div class="permission-input-container">');
    
    let div1 = $('<div>');
    div1.append('<div>Chọn địa phương</div>');
    div1.append('<select class="input-item border-input-item">');
    permissionInputContaienr.append(div1);

    let div2 = $('<div>');
    div2.append('<div>Ngày bắt đầu</div>');
    div2.append('<input type="date" class="input-item border-input-item">');
    permissionInputContaienr.append(div2);

    let div3 = $('<div>');
    div3.append('<div>Ngày Ngày kết thúc</div>');
    div3.append('<input type="date" class="input-item border-input-item">');
    permissionInputContaienr.append(div3);

    let div4 = $('<div>');
    div4.append('<button class="input-item confirm-button button-item">Xác nhận</button>');
    permissionInputContaienr.append(div4);

    let div5 = $('<div>');
    div5.append('<button class="input-item cancel-button button-item">Hủy</button>');
    permissionInputContaienr.append(div5);

    addPermissionContainer.append(permissionInputContaienr);
    $contentContainer.append(addPermissionContainer);
} 

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
        iconContainer.append('<span class="table-icon edit-icon"></span>');
        iconContainer.append('<span class="table-icon remove-icon"></span>');
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
        console.log(data);
        createGrantedPermissionTable(data.info);
    });
}