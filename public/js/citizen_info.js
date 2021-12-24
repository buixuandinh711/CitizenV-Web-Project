function getCitizenInfo() {
    fetch('get-citizen-info', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        console.log(data);
        setCitizenInfo(data)
    });
}
function setCitizenInfo(info) {
    $("#citizen-name").val(info.name);
    $("#citizen-id").val(info.id);
    $("#citizen-gender").val(info.gender);
    $("#citizen-dateofbirth").val(info.dateOfBirth);
    $("#citizen-permaddress").val(info.permanentAddress);
    $("#citizen-curaddress").val(info.currentAddress);
    $("#citizen-religion").val(info.religion);
    $("#citizen-grade").val(info.grade);
    $("#citizen-job").val(info.job);
}
getCitizenInfo();