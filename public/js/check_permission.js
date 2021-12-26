function checkPermission() {
    fetch('get-permission-location', {
        method: 'get',
        headers: {
            "Content-Type": "application/json",
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp) {
            $(".display-content").css("display", "block")
        } else {
            $(".non-permission-title").css("display", "block")
        }
    });
}
checkPermission();