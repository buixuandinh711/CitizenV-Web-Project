$("#search-citizen-button").click(function() {

    let citizenId = $("#search-citizen-id").val().trim();

    if (citizenId.length == 0) {
        setInputError("Chưa nhập mã số định danh!");
        return;
    }

    if (!citizenId.match(/^[0-9]{12}$/)) {
        setInputError("Mã số định danh sai định dạng!");
        return;
    }

    setInputError("");

})

function loadCitizenInfo(citizenId) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    fetch('get-citizen-info', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({ id: citizenId })
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp === "success") {
            setCitizenInfo(data)
            $("#info-container").css("display", "block")        
            $("#no-info-container").css("display", "none")        
        } else {
            $("#info-container").css("display", "none")        
            $("#no-info-container").css("display", "block")      
        }
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

function setInputError(err) {

    let errorHint = $("#search-citizen-error");

    if (err.length == 0) {
        errorHint.html("not error");
        errorHint.css("visibility", "hidden");
        return;
    }

    errorHint.html(err);
    errorHint.css("visibility", "visible");
}