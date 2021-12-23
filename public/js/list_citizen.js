var locationCode = $(".username").html();
function createLocationSelect(upperLocations) {

    let $selectContainer = $(".select-location-row");

    console.log(locationCode);

    if (locationCode === "admin") {
        $selectContainer.append('<select id="select-city" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-district" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-ward" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-village" type="text" class="input-item border-input-item list-citizen-select">');
    }

    if (locationCode.length == 2) {
        $selectContainer.append('<input id="select-city" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.city + '">');
        $selectContainer.append('<select id="select-district" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-ward" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-village" type="text" class="input-item border-input-item list-citizen-select">');
    }

    if (locationCode.length == 4) {
        $selectContainer.append('<input id="select-city" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.city + '">');
        $selectContainer.append('<input id="select-district" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.district + '">');
        $selectContainer.append('<select id="select-ward" type="text" class="input-item border-input-item list-citizen-select">');
        $selectContainer.append('<select id="select-village" type="text" class="input-item border-input-item list-citizen-select">');
    }

    if (locationCode.length == 6) {
        $selectContainer.append('<input id="select-city" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.city + '">');
        $selectContainer.append('<input id="select-district" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.district + '">');
        $selectContainer.append('<input id="select-ward" type="text" class="input-item border-input-item list-citizen-select" disabled value="'
            + upperLocations.ward + '">');
        $selectContainer.append('<select id="select-village" type="text" class="input-item border-input-item list-citizen-select">');
    }
    $selectContainer.append('<button class="input-item confirm-button" id="search-button">Xác nhận</button>');

}

createLocationSelect({});