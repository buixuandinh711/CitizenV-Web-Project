function init() {
    $("#declaration-dropdown").css("display", "block");
    $("#declare-status").css("color", "deepskyblue");
}

function createDeclaredStatusTable(declaredList) {

    let $declaredListContainer = $(".declare-status-container");
    let $titleStatusContainer = $(".title-status-contaier");
    $titleStatusContainer.empty();


    if ($("#status-list-table").length == 0 && declaredList.length != 0) {

        $titleStatusContainer.append('<h2 class="subtitle">Số địa phương được cấp quyền: ' + declaredList.length + '</h2>');
        let completeCount = declaredList.filter(item => item.isComplete).length;
        $titleStatusContainer.append('<h2 class="subtitle">Số địa phương hoàn thành: ' + completeCount + '</h2>')

        let declaredTable = $('<table class="data-table" id="status-list-table">');
        let tableHeader = $('<thead>');
        let headerRow = $('<tr>');

        headerRow.append('<th class="table-cell table-header">Tài khoản chịu trách nhiệm</th>');
        headerRow.append('<th class="table-cell table-header name-header-cell">Địa phương</th>');
        headerRow.append('<th class="table-cell table-header">Ngày kết thúc</th>');
        headerRow.append('<th class="table-cell table-header">Số lượng khai báo</th>');
        headerRow.append('<th class="table-cell table-header">Trạng thái</th>');

        tableHeader.append(headerRow);
        declaredTable.append(tableHeader);
        declaredTable.append('<tbody>');
        $declaredListContainer.append(declaredTable);
    }

    if (declaredList.length == 0) {
        $("#status-list-table").remove();
        $titleStatusContainer.append('<h2>Chưa có địa phương nào được cấp quyền khai báo!</h2>')
        return;
    }

    let $tableBody = $("#status-list-table tbody");
    $tableBody.empty();

    for (const info of declaredList) {

        let tableRow = $('<tr>');
        tableRow.append('<td class="table-cell">' + info.code + '</td>')
        tableRow.append('<td class="table-cell">' + info.name + '</td>')
        tableRow.append('<td class="table-cell">' + info.endDate + '</td>')
        tableRow.append('<td class="table-cell">' + info.declaredCitizen + '</td>')
        let status = info.isComplete ? "Hoàn thành" : "Chưa hoàn thành";
        tableRow.append('<td class="table-cell">' + status + '</td>')

        $tableBody.append(tableRow);
    }

}

function loadDeclareStatus() {
    fetch('get-declare-status', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        createDeclaredStatusTable(data)
    });
}

function loadCompleteStatus() {
    fetch('get-complete-status', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        updateCompleteStatus(data.isComplete);
    });
}

function changeCompleteStatus() {
    fetch('change-complete-status', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        updateCompleteStatus(data.isComplete);
    });
}

function updateCompleteStatus(isComplete) {
    let $pendingButton = $("#declare-status-pending");
    if (!isComplete) {
        $pendingButton.removeClass("cancel-button");
        $pendingButton.addClass("confirm-button");
        $pendingButton.html("Đánh dấu là hoàn thành")
    } else {
        $pendingButton.removeClass("confirm-button");
        $pendingButton.addClass("cancel-button");
        $pendingButton.html("Hủy đánh dấu hoàn thành")
    }
}

function loadLocationInfo() {
    fetch('get-location-info', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        $(".content-title").html("Tình trạng khai báo trên địa bàn " + data.name);
        if (data.code.length == 6) {
            $("#declare-status-pending").css("display", "block");
        }
    });
}

$("#list-citizen-pending").click(function () {
    changeCompleteStatus();
})

init();
loadLocationInfo();
loadDeclareStatus();
loadCompleteStatus();