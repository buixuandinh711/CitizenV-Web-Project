function init() {
    $("#management-dropdown").css("display", "block");
    $("#declare-location-nav").css("color", "deepskyblue");
}

init();

loadLocationInfo();
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
        $(".content-title").text("Khai báo địa phương thuộc địa bàn " + data.local)
        let declaredLocation = data.declared;
        declaredCodes = declaredLocation.map(item => item.code);
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