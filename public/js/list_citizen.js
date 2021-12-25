var locationCode = $(".username").html();
var cities = [];

var CITY_SELECT_DEFAULT = "Tỉnh, Thành phố";
var DISTRICT_SELECT_DEFAULT = "Quận, Huyện";
var WARD_SELECT_DEFAULT = "Xã, Phường";
var VILLAGE_SELECT_DEFAULT = "Thôn, Tổ dân phố";

function init() {
    $("#information-dropdown").css("display", "block");
    $("#list-citizen-page").css("color", "deepskyblue");
}

init();

function createLocationSelect(upperLocations) {

    let $selectContainer = $(".select-location-row");

    if (locationCode === "admin") {
        $selectContainer.append('<select id="select-city" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-district" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-ward" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-village" type="text" class="input-item border-input-item list-citizen-select">');
        resetAllSelector();
        loadCity();
    }

    if (locationCode.length == 2) {
        CITY_SELECT_DEFAULT = upperLocations.city;
        $selectContainer.append('<input id="select-city" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.city + '">');
        $selectContainer.append('<select id="select-district" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-ward" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-village" type="text" class="input-item border-input-item list-citizen-select">');
        resetAllSelector();
        loadDistrict(locationCode.substring(0, 2));
    }

    if (locationCode.length == 4) {
        CITY_SELECT_DEFAULT = upperLocations.city;
        DISTRICT_SELECT_DEFAULT = upperLocations.district;
        $selectContainer.append('<input id="select-city" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.city + '">');
        $selectContainer.append('<input id="select-district" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.district + '">');
        $selectContainer.append('<select id="select-ward" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-village" type="text" class="input-item border-input-item list-citizen-select">');
        resetAllSelector();
        loadWard(locationCode.substring(0, 4));
    }

    if (locationCode.length == 6) {
        CITY_SELECT_DEFAULT = upperLocations.city;
        DISTRICT_SELECT_DEFAULT = upperLocations.district;
        WARD_SELECT_DEFAULT = upperLocations.ward;
        $selectContainer.append('<input id="select-city" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.city + '">');
        $selectContainer.append('<input id="select-district" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.district + '">');
        $selectContainer.append('<input id="select-ward" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.ward + '">');
        $selectContainer.append('<select id="select-village" type="text" class="input-item border-input-item list-citizen-select">');
        resetAllSelector();
        loadVillage(locationCode.substring(0, 6));
    }
    $selectContainer.append('<button class="input-item confirm-button" id="search-button">Xác nhận</button>');


}

function loadUpperLocations() {
    fetch('get-upper-location', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        createLocationSelect(data);
    });
}

function loadCity() {

    fetch('get-city', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        let selector = $("#select-city")
        createSelectLocationOption(selector, data.info);
    });

}

function loadDistrict(city) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    fetch('get-district', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({ code: city })
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        let selector = $("#select-district");
        createSelectLocationOption(selector, data.info);
    });
}

function loadWard(district) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    fetch('get-ward', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({ code: district })
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        let selector = $("#select-ward");
        createSelectLocationOption(selector, data.info);
    });
}

function loadVillage(ward) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    fetch('get-village', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({ code: ward })
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        let selector = $("#select-village");
        createSelectLocationOption(selector, data.info);
    });
}

function loadCitizen(villageCode) {
    console.log(villageCode);
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    fetch('load-declared-citizen', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({ code: villageCode })
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp === "error") {
            createDeclaredCitizenTable([]);
        } else {
            createDeclaredCitizenTable(data);
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


function createSelectLocationOption(selector, locations) {
    for (const item of locations) {
        selector.append('<option value="' + item.code + '">' + item.name + '</option>');
    }
}

function resetSelector(selector, defaultVal) {
    if (selector.prop("tagName") !== "SELECT") {
        return;
    }
    selector.empty();
    selector.append('<option disabled="disabled" selected>' + defaultVal + '</option>')
}

function resetAllSelector() {
    resetSelector($("#select-city"), CITY_SELECT_DEFAULT);
    resetSelector($("#select-district"), DISTRICT_SELECT_DEFAULT);
    resetSelector($("#select-ward"), WARD_SELECT_DEFAULT);
    resetSelector($("#select-village"), VILLAGE_SELECT_DEFAULT);
}

function createDeclaredCitizenTable(citizenList) {

    let $citizenListContainer = $(".citizen-list-container");

    if ($("#table-title").length === 0) {
        $citizenListContainer.append('<h2 class="subtitle" id="table-title">Danh sách dân số</h2>');
    }

    if ($("#citizen-list-table").length == 0 && citizenList.length != 0) {

        $("#table-title").html("Danh sách dân số");

        let citizenTable = $('<table class="data-table" id="citizen-list-table">');
        let tableHeader = $('<thead>');
        let headerRow = $('<tr>');

        headerRow.append('<th class="table-cell table-header">Mã số định danh</th>');
        headerRow.append('<th class="table-cell table-header name-header-cell">Họ và tên</th>');
        headerRow.append('<th class="table-cell table-header">Giới tính</th>');
        headerRow.append('<th class="table-cell table-header">Ngày sinh</th>');

        tableHeader.append(headerRow);
        citizenTable.append(tableHeader);
        citizenTable.append('<tbody>');
        $citizenListContainer.append(citizenTable);
    }

    if (citizenList.length == 0) {
        $("#table-title").html("Không có dữ liệu dân số");
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

        $tableBody.append(tableRow);
    }

}

$("body").on("change", "#select-city", function () {
    let code = $(this).val();
    resetSelector($("#select-district"), DISTRICT_SELECT_DEFAULT);
    resetSelector($("#select-ward"), WARD_SELECT_DEFAULT);
    resetSelector($("#select-village"), VILLAGE_SELECT_DEFAULT);
    loadDistrict(code);
})

$("body").on("change", "#select-district", function () {
    let code = $(this).val();
    resetSelector($("#select-ward"), WARD_SELECT_DEFAULT);
    resetSelector($("#select-village"), VILLAGE_SELECT_DEFAULT);
    loadWard(code);
})

$("body").on("change", "#select-ward", function () {
    let code = $(this).val();
    resetSelector($("#select-village"), VILLAGE_SELECT_DEFAULT);
    loadVillage(code);
})

$("body").on("click", "#search-button", function () {
    let villageCode = $("#select-village").val();
    loadCitizen(villageCode);
})


$("body").on("click", "tbody tr", function () {

    let id = $(this).children(':first-child').html();
    postCheckInfo(id);

})

loadUpperLocations();