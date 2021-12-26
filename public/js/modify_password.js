function postModifyPassword(_oldPassword, _newPassword) {
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    fetch('edit-password', {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({oldPassword : _oldPassword, newPassword : _newPassword})
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.resp == "success") {
            clearInput();
            $.toast({
                heading: 'Đổi mật khẩu thành công',
                hideAfter: 1000,
                bgColor: '#00bfff',
                textColor: '#fff',
                loaderBg: '#fff'
            });
        } else {
            $.toast({
                heading: 'Đổi mật khẩu thất bại!',
                hideAfter: 1000,
                bgColor: '#ff0000',
                textColor: '#fff',
                loaderBg: '#fff'
            });
        }
    });
}

$("#submit-password").click(function() {
    let oldPassword = $("#old-password").val().trim();
    let newPassword = $("#new-password").val().trim();
    let newRepassword = $("#new-repassword").val().trim();

    if (oldPassword.length == 0 || newPassword.length == 0 || newRepassword == 0) {
        setInputError("Thông tin không được để trống!");
        return;
    }

    if (oldPassword === newPassword) {
        setInputError("Mật khẩu mới giống mật khẩu hiện tại!");
        return;
    }

    if(newPassword !== newRepassword) {
        setInputError("Nhập lại mật khẩu không chính xác!");
        return;
    }

    setInputError("");
    postModifyPassword(oldPassword, newPassword);

})
function setInputError(err) {

    let errorHint = $("#modify-password-error");

    if (err.length == 0) {
        errorHint.html("not error");
        errorHint.css("visibility", "hidden");
        return;
    }

    errorHint.html(err);
    errorHint.css("visibility", "visible");
}

function clearInput() {
    $("#old-password").val("");
    $("#new-password").val("");
    $("#new-repassword").val("");
}