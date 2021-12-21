var currentCitySelect = $("#add-citizen-curcity");
var currentDistrictSelect = $("#add-citizen-curdistrict");
var currentWardSelect = $("#add-citizen-curward");
var currentVillageSelect = $("#add-citizen-curvillage");

const CITY_SELECT_DEFAULT = "Tỉnh, Thành phố";
const DISTRICT_SELECT_DEFAULT = "Quận, Huyện";
const WARD_SELECT_DEFAULT = "Xã, Phường";
const VILLAGE_SELECT_DEFAULT = "Thôn, Tổ dân phố";

var cities = [];
var locationCode = "";

function loadCity() {

    if (cities.length == 0) {
        fetch('get-city', {
            method: 'get',
            headers: {
                "Content-Type": "application/json",
            }
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            cities = data.info;
            createSelectLocationOption($("#add-citizen-permcity"), cities);
            createSelectLocationOption($("#add-citizen-curcity"), cities);
        });
    } else {
        createSelectLocationOption($("#add-citizen-curcity"), cities);
    }


}

function loadDistrict(city, selector) {
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
        createSelectLocationOption(selector, data.info);
    });
}

function loadWard(district, selector) {
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
        createSelectLocationOption(selector, data.info);
    });
}

function loadVillage(ward, selector) {
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
        createSelectLocationOption(selector, data.info);
    });
}

function loadPermenentInfo() {
    fetch('get-upper-location', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        console.log(data);
        locationCode = data.code;
        $("#add-citizen-permcity").val(data.city);
        $("#add-citizen-permdistrict").val(data.district);
        $("#add-citizen-permward").val(data.ward);
        $("#add-citizen-permvillage").val(data.village);
    });
}

function postCitizen(_id, _name, _gender, _dataOfBirth, _permanentAddress, _currentAddress, _religion, _grade, _job) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    let citizen = {
        id: _id, name: _name, gender: _gender, dateOfBirth: _dataOfBirth, permanentAddress: _permanentAddress
        , currentAddress: _currentAddress, religion: _religion, grade: _grade, job: _job
    };
    fetch('submit-new-citizen', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify(citizen)
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp == "success") {
            clearInput();
            $.toast({
                heading: 'Thêm dữ liệu công dân thành công!',
                hideAfter: 1000,
                bgColor: '#00bfff',
                textColor: '#fff',
                loaderBg: '#fff'
            });
        } else {
            $.toast({
                heading: 'Thêm dữ liệu công dân thất bại!',
                hideAfter: 1000,
                bgColor: '#ff0000',
                textColor: '#fff',
                loaderBg: '#fff'
            });
        }
    });
}

function createSelectLocationOption(selector, locations) {
    for (const item of locations) {
        selector.append('<option value="' + item.code + '">' + item.name + '</option>');
    }
}

loadCity();
loadPermenentInfo();

currentCitySelect.change(function () {
    let cityCode = $(this).val();
    resetSelector(currentDistrictSelect, DISTRICT_SELECT_DEFAULT);
    resetSelector(currentWardSelect, WARD_SELECT_DEFAULT);
    resetSelector(currentVillageSelect, VILLAGE_SELECT_DEFAULT);
    loadDistrict(cityCode, currentDistrictSelect);
})
currentDistrictSelect.change(function () {
    let districtCode = $(this).val();
    resetSelector(currentWardSelect, WARD_SELECT_DEFAULT);
    resetSelector(currentVillageSelect, VILLAGE_SELECT_DEFAULT);
    loadWard(districtCode, currentWardSelect);
})
currentWardSelect.change(function () {
    let wardCode = $(this).val();
    resetSelector(currentVillageSelect, VILLAGE_SELECT_DEFAULT);
    loadVillage(wardCode, currentVillageSelect);
})

$("#add-citizen-submit").click(function () {

    let citizenId = $("#add-citizen-id").val().trim();
    let citizenName = $("#add-citizen-name").val().trim().replace(/\s{2,}/g, ' ');
    let gender = $("#add-citizen-gender").val();
    let dateOfBirth = $("#add-citizen-dateofbirth").val();
    let currentCity = currentCitySelect.val();
    let currentDistrict = currentDistrictSelect.val();
    let currentWard = currentWardSelect.val();
    let currentVillage = currentVillageSelect.val();
    let religion = $("#add-citizen-religion").val().trim().replace(/\s{2,}/g, ' ');
    let grade = $("#add-citizen-grade").val().trim().replace(/\s{2,}/g, ' ');
    let job = $("#add-citizen-job").val().trim().replace(/\s{2,}/g, ' ');

    if (citizenId.length == 0 || citizenName.length == 0 || !gender || dateOfBirth.length == 0
        || !currentCity || !currentDistrict || !currentWard || !currentVillage
        || religion.length == 0 || grade.length == 0 || job.length == 0) {
        setInputError("Thông tin không được để trống");
        return;
    }

    if (!citizenId.match(/^[0-9]{12}$/)) {
        setInputError("Mã số định danh sai định dạng!");
        return;
    }

    setInputError("");
    postCitizen(citizenId, citizenName, gender, dateOfBirth, locationCode, currentVillage, religion, grade, job);

});

$("#add-citizen-cancel").click(function () {
    clearInput();
});

function clearInput() {

    let citizenId = $("#add-citizen-id").val("");
    let citizenName = $("#add-citizen-name").val("");
    $("#add-citizen-gender option[disabled='disabled']").prop("selected", true);
    let dateOfBirth = $("#add-citizen-dateofbirth").val("");

    resetSelector($("#add-citizen-curcity"), CITY_SELECT_DEFAULT);
    resetSelector($("#add-citizen-curdistrict"), DISTRICT_SELECT_DEFAULT);
    resetSelector($("#add-citizen-curward"), WARD_SELECT_DEFAULT);
    resetSelector($("#add-citizen-curvillage"), VILLAGE_SELECT_DEFAULT);

    $("#add-citizen-religion").val("");
    $("#add-citizen-grade").val("");
    $("#add-citizen-job").val("");
    loadCity();

}

function resetSelector(selector, defaultVal) {
    selector.empty();
    selector.append('<option disabled="disabled" selected>' + defaultVal + '</option>')
}

function setInputError(err) {

    let errorHint = $("#add-citizen-error");

    if (err.length == 0) {
        errorHint.html("not error");
        errorHint.css("visibility", "hidden");
        return;
    }

    errorHint.html(err);
    errorHint.css("visibility", "visible");
}