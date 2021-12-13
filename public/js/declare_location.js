$("#declare-location-nav").click(function () {
    createLocationPage();
})
function addLocationRow() {
    let $locationRow = $('<div class="location-row">');
    $locationRow.append('<input type="text" class="location-code location-input" placeholder="Mã địa phương" id="location-code">');
    $locationRow.append('<input type="text" class="location-name location-input" placeholder="Tên địa phương" id="location-name">');
    $locationRow.append('<button class="location-button confirm-button" id="submit-location">Thêm</button>');
    $locationRow.append('<button class="location-button cancel-button" id="cancel-location">Hủy</button>');
    $(".location-container").append($locationRow);
}
function createLocationPage() {
    $contenContainer = $(".content-container");
    if ($contenContainer.children().length > 0) {
        return;
    }
    $contenContainer.append('<h2 class="content-title"></h2>');
    $locationContainer = $('<div class="location-container">');
    $contenContainer.append($locationContainer);
    addLocationRow();
    $locationContainer.append('<span class="input-error" id="location-input-error"></span>');
    loadLocationInfo();
}
var declaredCodes = [];
function loadLocationInfo() {
    fetch('current-local-info', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        $(".content-title").text("Khai báo, cấp mã địa phương thuộc " + data.local)
        declaredCodes = data.codes;
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
            declaredCodes = data.codes;
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
$('body').on('click', '#submit-location', function () {
    let locationCode = $("#location-code").val().trim();
    let locationName = $("#location-name").val().trim();
    let $errorDisplay = $("#location-input-error");
    if (locationCode.length == 0 || locationName.length == 0) {
        $errorDisplay.html("Mã địa phương và tên địa phương không được trống!");
        return;
    }
    if (locationCode.length == 1) {
        locationCode = "0" + locationCode;
    }
    if (!locationCode.match(/^[0-9]{2}$/)) {
        $errorDisplay.html("Mã địa phương sai định dạng");
        return;
    }
    if (declaredCodes.includes(locationCode)) {
        $errorDisplay.html("Mã địa phương đã tồn tại");
        return;
    }
    $errorDisplay.html("");
    postLocation(locationCode, locationName);
});
$('body').on('keyup', '#location-code, #location-name', function () {
    $("#location-input-error").empty();
})
$('body').on('click', '#cancel-location', function () {
    $("#location-code").val("");
    $("#location-name").val("");
});