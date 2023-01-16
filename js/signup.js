"use strict";

/**
 * Check if email is formatted correctly.
 */
$(function () {
    //$("#signup-form > div:nth-child(4)").hide();
    $("#email").blur(function (e) {
        const target = e.currentTarget;
        //var isAvailable = 4;
        // Email availability
        if ($(target).val().length > 0) {
            if (!checkEmail($(target).val())) {
                // Email validity
                //$(target).addClass("invalid");
                $("#signup-form > div:nth-child(4) > span.message").text("Invalid email format");
                $("#signup-form > div:nth-child(4)").addClass("invalid").show();
                $(target).removeClass("valid");
                //alert("Invalid username")
            } else {
                $.ajax({
                    type: "POST",
                    url: "php/api_email.php",
                    data: $(this).serialize()
                }).then(
                    response => {
                        const jsonData = JSON.parse(response);

                        if (jsonData.available === 1) {
                            //$(target).removeClass("invalid");
                            $("#signup-form > div:nth-child(4) > span.message").text("");
                            $("#signup-form > div:nth-child(4)").removeClass("invalid").hide();
                            $(target).addClass("valid");
                        } else if (jsonData.available === 0) {
                            // Email has already been registered
                            //$(target).addClass("invalid");
                            $("#signup-form > div:nth-child(4) > span.message").text("Email is already taken");
                            $("#signup-form > div:nth-child(4)").addClass("invalid").show();
                            $(target).removeClass("valid");
                        } else if (jsonData.available === -1) {
                            alert("Unknown error");
                        }
                    },
                    // reject/failure callback
                    function () {
                        alert("Could not check email availability!");
                    }
                );
            }
        } else {
            //$(target).removeClass("invalid");
            $("#signup-form > div:nth-child(4) > span.message").text("");
            $("#signup-form > div:nth-child(4)").removeClass("invalid").hide();
            $(target).removeClass("valid");
        }
    });
});

/**
 * Check if username is formatted correctly.
 */
$(function () {
    //$("#signup-form > div:nth-child(6)").hide();
    $("#username").on("input", function (e) {
        const target = e.currentTarget;
        if ($(target).val().length > 0 &&
            !checkUsername($(target).val())) {
            //$(target).addClass("invalid");
            $("#signup-form > div:nth-child(6) > span.message").text("Invalid username format");
            $("#signup-form > div:nth-child(6)").addClass("invalid").show();
            $(target).removeClass("valid");
            //alert("Invalid username")
        } else {
            //$(target).removeClass("invalid");
            $("#signup-form > div:nth-child(6) > span.message").text("");
            $("#signup-form > div:nth-child(6)").removeClass("invalid").hide();
            $(target).removeClass("valid");
        }
    }).blur(function (e) {
        const target = e.currentTarget;
        if ($(target).val().length > 0) {
            $.ajax ({
                type: "POST",
                url: "php/api_username.php",
                data: $(this).serialize()
            }).then(
                response => {
                    const jsonData = JSON.parse(response);

                    if (jsonData.available === 1) {
                        $("#signup-form > div:nth-child(6) > span.message").text("");
                        $("#signup-form > div:nth-child(6)").removeClass("invalid").hide();
                        $(target).addClass("valid");
                    } else if (jsonData.available === 0) {
                        // Username has already been registered
                        //$(target).addClass("invalid");
                        $("#signup-form > div:nth-child(6) > span.message").text("Username is already taken");
                        $("#signup-form > div:nth-child(6)").addClass("invalid").show();
                        $(target).removeClass("valid");
                    } else if (jsonData.available === -1) {
                        alert("Unknown error");
                    }
                },
                // reject/failure callback
                function () {
                    alert("Could not check username availability!");
                }
            );
        }
    });
});

/**
 * Check if password is formatted correctly.
 */
$(function () {
    //$("#signup-form > div:nth-child(8)").hide();
    $("#password").on("input", function (e) {
        const target = e.currentTarget;
        if ($(target).val().length > 0 &&
            !checkPassword($(target).val())) {
            //$(target).addClass("invalid");
            $("#signup-form > div:nth-child(8) > span.message").text("Character not allowed");
            $("#signup-form > div:nth-child(8)").addClass("invalid").show();
            $(target).removeClass("valid");
        } else {
            //$(target).removeClass("invalid");
            $("#signup-form > div:nth-child(8) > span.message").text("");
            $("#signup-form > div:nth-child(8)").removeClass("invalid").hide();
            if ($(target).val().length >= 8 && $(target).val().length <= 128) {
                $(target).addClass("valid");
            } else {
                $(target).removeClass("valid");
            }
        }
    }).blur(function (e) {
        const target = e.currentTarget;
        if ($(target).val().length < 8 &&
            $(target).val().length > 0) {
            //$(target).addClass("invalid");
            $("#signup-form > div:nth-child(8) > span.message").text("Password is too short");
            $("#signup-form > div:nth-child(8)").addClass("invalid").show();
            $(target).removeClass("valid");
        } else if ($(target).val().length > 128) {
            //$(target).addClass("invalid");
            $("#signup-form > div:nth-child(8) > span.message").text("Password is too long");
            $("#signup-form > div:nth-child(8)").addClass("invalid").show();
            $(target).removeClass("valid");
        } else {
            //$(target).removeClass("invalid");
            $("#signup-form > div:nth-child(8) > span.message").text("");
            $("#signup-form > div:nth-child(8)").removeClass("invalid").hide();
            $(target).addClass("valid");
        }
    });
});

/**
 * Enable submit button when input fields are not empty anymore and are valid.
 */
$(function () {
    $("#submit-button").prop("disabled", true);
    const email = $("#email");
    const full_name = $("#full_name");
    const username = $("#username");
    const password = $("#password");
    $("input").on("input", function () {
        if ($(email).val() &&
            $(full_name).val() &&
            $(username).val() &&
            $(password).val() &&
            $(email).hasClass("valid") &&
            $(username).hasClass("valid") &&
            $(password).hasClass("valid")) {
            $("#submit-button").prop("disabled", false);
        } else {
            $("#submit-button").prop("disabled", true);
        }
    });
});

/**
 * AJAX signup check on submit button click.
 */
$(function () {
    $("#signup-form").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "php/api_signup.php",
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
        );
    });
});