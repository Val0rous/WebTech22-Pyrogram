"use strict";

/**
 * Set input box border color to red when a login fails.
 * @param e target
 */
function loginError(e) {
    $(".input-box").addClass("error");
}

/**
 * Check if username/email is formatted correctly.
 */
/*
$(function () {
    $("#username_email").blur(function (e) {
        const target = e.currentTarget;
        if (!checkUsername($(target).val()) && !checkEmail($(target).val())) {
            $(target).addClass("invalid");
            //alert("Invalid username")
        } else {
            $(target).removeClass("invalid");
        }
    })
})
*/

/**
 * Check if password is formatted correctly.
 */
/*
$(function () {
    $("#password").blur(function (e) {
        const target = e.currentTarget;
        if (!checkPassword($(target).val())) {
            $(target).addClass("invalid");
        } else {
            $(target).removeClass("invalid");
        }
    })
})
*/

/**
 * Enable submit button when input fields are not empty anymore.
 */
$(function () {
    $("#submit-button").prop("disabled", true);
    $("input").on("input", function () {
        if ($("#username_email").val() &&
            $("#password").val().length >= 8 /*&&
            !$("#username_email").hasClass("invalid") &&
            !$("#password").hasClass("invalid")*/) {
            $("#submit-button").prop("disabled", false);
        } else {
            $("#submit-button").prop("disabled", true);
        }
    });
});

/**
 * AJAX login check on submit button click.
 */
$(function () {
    $("#login-form").submit(function (e) {
        e.preventDefault();
        //check if username is valid
        //check if email is valid
        //check if password is valid
        //apply same checks to signup too, using a shared file.


        $.ajax({
            type: "POST",
            url: "php/api_login.php",
            data: $(this).serialize()
        }).then(
            //resolve success callback
            response => {
                const jsonData = JSON.parse(response);

                //user is logged in successfully in the back-end
                //let's redirect
                if (jsonData.success === 1) {
                    location.href = "home.php";
                } else {
                    //alert("Invalid Credentials!");
                    alert("Username/Email or Password not valid!");
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
