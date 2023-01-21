/**
 * Enable submit button when input fields are not empty anymore.
 */
$(function () {
    $("#submit-button").prop("disabled", true);
    $("#post_content").on("input", function () {
        if ($("#post_content").val()) {
            $("#submit-button").prop("disabled", false);
        } else {
            $("#submit-button").prop("disabled", true);
        }
    });
});

/**
 * AJAX create post on submit button click.
 */
$(function() {
    $("#create-form").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "php/api_create.php",
            data: $(this).serialize()
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