$("#information-dropdown").css("display", "block");
$("#information-dropdown a").css("color", "deepskyblue");

var locationInfo = {};
var citizenList = [];

function loadLocationInfo() {
    fetch('get-location-info', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        locationInfo = data;
        $(".content-title").html("Danh sách dân cư trên địa bàn " + locationInfo.name);
    });
}

function loadCitizen() {
    let locationCode = $(".username").html();
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    fetch('load-declared-citizen', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({ code: locationCode })
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        citizenList = data;
        createDeclaredCitizenTable(citizenList);
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

loadLocationInfo();
loadCitizen();
loadCompleteStatus();

function createDeclaredCitizenTable(citizenList) {

    let $citizenListContainer = $(".citizen-list-container");


    if ($(".total-declared-citizen").length == 0) {
        $citizenListContainer.append('<h2 class="total-declared-citizen"></h2>')
    }
    $(".total-declared-citizen").html("Tổng số dân cư đã khai báo: " + citizenList.length);

    if ($("#citizen-list-table").length == 0 && citizenList.length != 0) {

        let citizenTable = $('<table class="data-table" id="citizen-list-table">');
        let tableHeader = $('<thead>');
        let headerRow = $('<tr>');

        headerRow.append('<th class="table-cell table-header">Mã số định danh</th>');
        headerRow.append('<th class="table-cell table-header name-header-cell">Họ và tên</th>');
        headerRow.append('<th class="table-cell table-header">Giới tính</th>');
        headerRow.append('<th class="table-cell table-header">Ngày sinh</th>');
        headerRow.append('<th class="table-cell table-header">Thao tác</th>');

        tableHeader.append(headerRow);
        citizenTable.append(tableHeader);
        citizenTable.append('<tbody>');
        $citizenListContainer.append(citizenTable);
    }

    if (citizenList.length == 0) {
        $("#citizen-list-table").remove();
        return;
    }

    let $tableBody = $("#citizen-list-table tbody");
    $tableBody.empty();

    for (const citizen of citizenList) {

        let tableRow = $('<tr>');
        tableRow.append('<td class="table-cell">' + citizen.id + '</td>')
        tableRow.append('<td class="table-cell">' + citizen.name + '</td>')
        tableRow.append('<td class="table-cell">' + citizen.gender + '</td>')
        tableRow.append('<td class="table-cell">' + citizen.dateOfBirth + '</td>')

        let handlerCell = $('<td class="table-cell handler-cell">');
        let handlerContainer = $('<div class="handler-container">');
        handlerContainer.append('<span class="modify-delete">Xóa</span>');
        handlerCell.append(handlerContainer);
        tableRow.append(handlerCell);

        $tableBody.append(tableRow);
    }

}

function postDelete(_id) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    fetch('delete-person', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({ id: _id })
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp = "success") {
            $.toast({
                heading: 'Xóa khai báo thành công thành công!',
                hideAfter: 1000,
                bgColor: '#00bfff',
                textColor: '#fff',
                loaderBg: '#fff'
            });
            citizenList = citizenList.filter(item => item.id != _id);
            createDeclaredCitizenTable(citizenList);
        } else {
            $.toast({
                heading: 'Xóa khai báo thành công thất bại!',
                hideAfter: 1000,
                bgColor: '#ff0000',
                textColor: '#fff',
                loaderBg: '#fff'
            });
        }
    });
}

function postCheckInfo(_id) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    fetch('check-citizen-info', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({ id: _id })
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp === "success") {
            window.location.href = "citizen-info";
        }
    });
}


$("body").on("click", ".modify-delete", function () {
    let citizenId = $(this).parent().parent().parent().children(':first-child').html();
    postDelete(citizenId);
})

function updateCompleteStatus(isComplete) {
    let $pendingButton = $("#list-citizen-pending");
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

$("#list-citizen-pending").click(function () {
    changeCompleteStatus();
})

$("body").on("click", "tbody td:not(:last-child)", function () {

    let id = $(this).parent().children(':first-child').html();
    postCheckInfo(id);

})