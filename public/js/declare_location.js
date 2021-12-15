$("#declare-location-nav").click(function () {
    createLocationPage();
})
function createLocationPage() {
    let $contenContainer = $(".content-container");
    $contenContainer.empty();
    $contenContainer.append('<h2 class="content-title">Cấp mã cho Tỉnh/Thành phố</h2>');

    let $addLocationContainer = $('<div class="add-location-container">');
    $addLocationContainer.append('<h2>Thêm địa phương mới</h2>');
    let $locationInputContainer = $('<div class="location-input-container">');

    let $div1 = $('<div>');
    $div1.append('<input type="text" class="input-item border-input-item" id="declare-location-code" placeholder="Mã địa phương">');
    $locationInputContainer.append($div1);

    let $div2 = $('<div>');
    $div2.append('<input type="text" class="input-item border-input-item" id="declare-location-name" placeholder="Tên địa phương">');
    $locationInputContainer.append($div2);

    let $div3 = $('<div>');
    $div3.append('<button class="input-item confirm-button button-item" id="submit-new-location">Xác nhận</button>');
    $locationInputContainer.append($div3);

    let $div4 = $('<div>');
    $div4.append('<button class="input-item cancel-button button-item" id="cancel-new-location">Hủy</button>');
    $locationInputContainer.append($div4);

    $addLocationContainer.append($locationInputContainer);
    $addLocationContainer.append('<div class="error-hint" id="location-input-error"></div>');
    $contenContainer.append($addLocationContainer);
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
    let location = [{ code: _code, name: _name }];
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
            clearInput();
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
$('body').on('click', '#submit-new-location', function () {
    let locationCode = $("#declare-location-code").val().trim();
    let locationName = $("#declare-location-name").val().trim();
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
$('body').on('keydown', '#declare-location-code, #declare-location-name', function () {
    $("#location-input-error").empty();
})
$('body').on('click', '#cancel-new-location', function () {
   clearInput();
})
function clearInput() {
    $("#declare-location-code").val("");
    $("#declare-location-name").val("");
    $("#location-input-error").empty();
}