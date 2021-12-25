$("#management").click(function () {
    let $dropdown = $("#management-dropdown");
    if ($dropdown.css("display") == "none") {
        $dropdown.css("display", "block");
    } else {
        $dropdown.css("display", "none");
    }
})
$("#declaration").click(function () {
    let $dropdown = $("#declaration-dropdown");
    if ($dropdown.css("display") == "none") {
        $dropdown.css("display", "block");
    } else {
        $dropdown.css("display", "none");
    }
})
$("#information").click(function () {
    let $dropdown = $("#information-dropdown");
    if ($dropdown.css("display") == "none") {
        $dropdown.css("display", "block");
    } else {
        $dropdown.css("display", "none");
    }
})
$("#account-caret").click(function () {
    let $dropdown = $(".account-dropdown");
    if ($dropdown.css("display") == "none") {
        $dropdown.css("display", "block");
    } else {
        $dropdown.css("display", "none");
    }
})
function parseDate(s) {
    var b = s.split(/\D/);
    return new Date(b[0], --b[1], b[2]);
}
$(".menu-icon").click(function() {
    let $aside = $("aside");
    if ($aside.css("display") == "none") {
        $aside.css("display", "block");
    } else {
        $aside.css("display", "none");
    }
})