$("#declare-location-nav").click(function () {
    createLocationPage();
})
function addLocationRow() {
    let $locationRow = $('<div class="location-row">');
    $locationRow.append('<input type="text" class="location-code location-input" placeholder="Mã địa phương">');
    $locationRow.append('<input type="text" class="location-name location-input" placeholder="Tên địa phương">');
    $locationRow.append('<button class="location-button confirm-button">Thêm</button>');
    $locationRow.append('<button class="location-button cancel-button">Hủy</button>');
    $(".location-container").append($locationRow);
}
function createLocationPage() {
    $contenContainer = $(".content-container");
    if ($contenContainer.children().length > 0) {
        return;
    }
    $contenContainer.append('<h2 class="content-title">Cấp mã cho Tỉnh/Thành phố</h2>');
    $locationContainer = $('<div class="location-container">');
    $contenContainer.append($locationContainer);
    addLocationRow();
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
        let info = data.Result;
        $(".content-title").text("Khai báo, cấp mã địa phương thuộc " + info.name)
        declaredCodes = info.codes;
    });
}