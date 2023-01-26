$(function () {
    $("div.top-bar > button").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "php/api_logout.php",
        }).then(
            // resolve success callback
            response => {
                // user is logged out
                // redirect to login page
                location.href = "login.php";
            },
            // reject/failure callback
            function () {
                alert("There was some error!");
            }
        );
    });
});