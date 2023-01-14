"use strict";

/**
 * Check if email is formatted correctly.
 */
$(function () {
    $("#email").blur(function (e) {
        const target = e.currentTarget;
        if ($(target).val() !== "" &&
            !checkEmail($(target).val())) {
            $(target).addClass("invalid");
            //alert("Invalid username")
        } else {
            $(target).removeClass("invalid");
        }
    })
})

/**
 * Check if username is formatted correctly.
 */
$(function () {
    $("#username").blur(function (e) {
        const target = e.currentTarget;
        if ($(target).val() !== "" &&
            !checkUsername($(target).val())) {
            $(target).addClass("invalid");
            //alert("Invalid username")
        } else {
            $(target).removeClass("invalid");
        }
    })
})

/**
 * Check if password is formatted correctly.
 */
$(function () {
    $("#password").blur(function (e) {
        const target = e.currentTarget;
        if ($(target).val() !== "" &&
            !checkPassword($(target).val())) {
            $(target).addClass("invalid");
        } else {
            $(target).removeClass("invalid");
        }
    })
})

/**
 * Enable submit button when input fields are not empty anymore and are valid.
 */
$(function () {
    $("#submit-button").prop("disabled", true);
    $("input").keyup(function () {
        if ($("#email").val() &&
            $("#full_name").val() &&
            $("#username").val() &&
            $("#password").val() &&
            !$("#email").hasClass("invalid") &&
            !$("#username").hasClass("invalid") &&
            !$("#password").hasClass("invalid")) {
            $("#submit-button").prop("disabled", false);
        } else {
            $("#submit-button").prop("disabled", true);
        }
    })
})

/**
 * AJAX signup check on submit button click.
 */
$(function () {
    $("#signup-form").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "api_signup.php",
            data: $(this).serialize()
        }).then(
            //resolve success callback
            response => {
                const jsonData = JSON.parse(response);

                //user has been successfully registered in the back-end
                if (jsonData.success === 1) {
                    location.href = "login.php"; //consider performing an email verification
                } else {
                    alert("User could not be registered!");
                }
            },
            //reject/failure callback
            function () {
                alert("There was some error!");
            }
        )
    })
})