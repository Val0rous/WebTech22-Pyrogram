/**
 * Button click
 */
$(function () {
    $("div.top-bar > button").click(function (e) {
        $("main > div > form").submit();
    });
});

/**
 * Form submit
 */
$(function () {
    $("main > div > form").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "php/api_edit_profile.php",
            data: $(this).serialize()
        }).then(
            // resolve success callback
            response => {
                const jsonData = JSON.parse(response);

                // user info updated
                // redirect to profile
                if (jsonData.success === 1) {
                    location.href = "profile.php";
                } else {
                    alert("Username not available");
                }
            },
            // reject/failure callback
            function () {
                alert("There was some error!");
            }
        );
    });
});