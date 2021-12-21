$("#add-citizen-submit").click(function() {

    let citizenId = $("#add-citizen-id").val().trim();
    let citizenName = $("#add-citizen-name").val().trim().replace(/\s{2,}/g, ' ');
    let gender = $("#add-citizen-gender").val();
    let dateOfBirth = $("#add-citizen-dateofbirth").val();
    let permanentCity = $("#add-citizen-permcity").val();
    let permanentDistrict = $("#add-citizen-permdistrict").val();
    let permanentWard = $("#add-citizen-permward").val();
    let permanentVillage = $("#add-citizen-permvillage").val();
    let currentCity = $("#add-citizen-curcity").val();
    let currentDistrict = $("#add-citizen-curdistrict").val();
    let currentWard = $("#add-citizen-curward").val();
    let currentVillage = $("#add-citizen-curvillage").val();
    let religion = $("#add-citizen-religion").val().trim().replace(/\s{2,}/g, ' ');
    let grade = $("#add-citizen-grade").val().trim().replace(/\s{2,}/g, ' ');
    let job = $("#add-citizen-job").val().trim().replace(/\s{2,}/g, ' ');

    if (citizenId.length == 0 || citizenName.length == 0 || !gender || dateOfBirth.length == 0
        // || !permanentCity || !permanentDistrict || !permanentWard || !permanentVillage
        // || !currentCity || !currentDistrict || !currentWard || !currentVillage
        || religion.length == 0 || grade.length == 0 || job.length == 0) {
        setInputError("Thông tin không được để trống");
        return;
    }

    if (!citizenId.match(/^[0-9]{12}$/)) {
        setInputError("Mã số định danh sai định dạng!");
        return;
    }

    console.log("success");
    setInputError("");

    
});

$("#add-citizen-cancel").click(function() {
    clearInput();
});

function clearInput() {

    let citizenId = $("#add-citizen-id").val("");
    let citizenName = $("#add-citizen-name").val("");
    $("#add-citizen-gender option[disabled='disabled']").prop("selected", true);
    let dateOfBirth = $("#add-citizen-dateofbirth").val("");
    
    resetSelector($("#add-citizen-permcity"), "Tỉnh, Thành phố");
    resetSelector($("#add-citizen-permdistrict"), "Quận, Huyện");
    resetSelector($("#add-citizen-permward"), "Xã, Phường");
    resetSelector($("#add-citizen-permvillage"), "Thôn, Tổ dân phố");
    resetSelector($("#add-citizen-curcity"), "Tỉnh, Thành phố");
    resetSelector($("#add-citizen-curdistrict"), "Quận, Huyện");
    resetSelector($("#add-citizen-curward"), "Xã, Phường");
    resetSelector($("#add-citizen-curvillage"), "Thôn, Tổ dân phố");

    $("#add-citizen-religion").val("");
    $("#add-citizen-grade").val("");
    $("#add-citizen-job").val("");

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