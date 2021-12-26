function init() {
    $("#management-dropdown").css("display", "block");
    $("#declare-location-nav").css("color", "deepskyblue");
}

init();

var declaredCodes = [];
var declaredLocation = []
var locationCode = $(".username").val();

function loadLocationInfo() {
    fetch('current-local-info', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        $(".content-title").text("Khai báo địa phương thuộc địa bàn " + data.local)
        declaredLocation = data.declared;
        declaredCodes = declaredLocation.map(item => item.code);
        createDeclaredLocationTable(declaredLocation);
    });
}
function postLocation(_code, _name) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    let location = { code: _code, name: _name };
    fetch('update-new-location', {
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
            declaredLocation.push({code : _code, name : _name});
            declaredCodes.push(_code);
            createDeclaredLocationTable(declaredLocation);
            clearLocationInput();
            $.toast({
                heading: 'Thêm địa phương thành công',
                hideAfter: 1000,
                bgColor: '#00bfff',
                textColor: '#fff',
                loaderBg: '#fff'
            });

        }
    });

}

function postDeleteRequest(_code) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    let location = { code: _code };
    fetch('delete-location', {
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
            declaredCodes = declaredCodes.filter(item => item !== _code);
            declaredLocation = declaredLocation.filter(item => item.code != _code);
            createDeclaredLocationTable(declaredLocation);

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

$('body').on('click', '#submit-new-location', function () {
    let locationCode = $("#declare-location-code").val().trim();
    let locationName = $("#declare-location-name").val().trim();
    let $errorDisplay = $("#location-input-error");
    if (locationCode.length == 0 || locationName.length == 0) {
        setInputError("Mã địa phương và tên địa phương không được trống!");
        return;
    }
    if (locationCode.length == 1) {
        locationCode = "0" + locationCode;
    }
    if (!locationCode.match(/^[0-9]{2}$/)) {
        setInputError("Mã địa phương sai định dạng");
        return;
    }
    if (declaredCodes.includes(locationCode)) {
        setInputError("Mã địa phương đã tồn tại");
        return;
    }
    setInputError("");
    postLocation(locationCode, locationName);
});
$('body').on('keydown', '#declare-location-code, #declare-location-name', function () {
    $("#location-input-error").empty();
})

$('body').on('click', '#cancel-new-location', function () {
   clearLocationInput();
})
function clearLocationInput() {
    $("#declare-location-code").val("");
    $("#declare-location-name").val("");
    $("#location-input-error").empty();
}
function setInputError(err) {

    let errorHint = $("#location-input-error");

    if (err.length == 0) {
        errorHint.html("not error");
        errorHint.css("visibility", "hidden");
        return;
    }

    errorHint.html(err);
    errorHint.css("visibility", "visible");
}

function createDeclaredLocationTable(declaredList) {

    if ($(".declared-location-container").length == 0 && declaredList.length != 0) {
        let declaredLocationContainer = $('<div class="declared-location-container">');
        declaredLocationContainer.append('<h2>Địa phương đã khai báo</h2>');

        let declaredTable = $('<table class="data-table" id="declared-location-table">');
        let tableHeader = $('<thead>');
        let headerRow = $('<tr>');

        headerRow.append('<th class="table-cell table-header">Mã địa phương</th>');
        headerRow.append('<th class="table-cell table-header">Tên địa phương</th>');
        headerRow.append('<th class="table-cell table-header header-icon">Thao tác</th>');

        tableHeader.append(headerRow);
        declaredTable.append(tableHeader);
        declaredTable.append('<tbody>');
        declaredLocationContainer.append(declaredTable);
        $(".display-content").append(declaredLocationContainer);
    }

    if (declaredList.length == 0) {
        $(".declared-location-container").remove();
        return;
    }

    let $tableBody = $("#declared-location-table tbody");
    $tableBody.empty();

    for (const declaredLocation of declaredList) {
        let tableRow = $('<tr>');
        tableRow.append('<td class="table-cell">' + declaredLocation.code + '</td>')
        tableRow.append('<td class="table-cell">' + declaredLocation.name + '</td>')

        let handlerCell = $('<td class="table-cell handler-cell">');
        let handlerContainer = $('<div class="handler-container">');
        handlerContainer.append('<span class="modify-delete">Xóa</span>');
        handlerCell.append(handlerContainer);
        tableRow.append(handlerCell);

        $tableBody.append(tableRow);
    }

}

$("body").on("click", ".modify-delete", function() {
    let $codeCell = $(this).parent().parent().parent().children(':first-child');
    let code = $codeCell.html();
    let name = $codeCell.next().html();
    postDeleteRequest(code, name);
})

loadLocationInfo();
