$(function () {
    $("#submit-button").prop("disabled", true);
    $("article > main > input").on("input", function () {
        if ($("article > main > input").val()) {
            $("#submit-button").prop("disabled", false);
        } else {
            $("#submit-button").prop("disabled", true);
        }
    });
});

$(function() {
    $("#submit-button").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "php/api_create.php",
            data: $("article > main > input").serialize()
        }).then(
            //resolve success callback
            response => {
                const jsonData = JSON.parse(response);

                //post created successfully in the back-end
                //let's redirect
                if (jsonData.success === 1) {
                    location.href = "home.php";
                } else {
                    //alert("Invalid Credentials!");
                    alert("Couldn't create post!");
                    loginError(e);
                }
            },
            //reject/failure callback
            function () {
                alert("There was some error!");
            }
        );
    });
});