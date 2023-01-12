/**
 * Toggle between show and hide password.
 */
$(function () {
    //$("#login-form > div:nth-child(3) > button").click(function(e) {
    $("button.show-password, button.hide-password").click(function (e) {
        const target = e.currentTarget;
        if ($(target).hasClass("show-password")) {
            showPassword($(target));
        } else if ($(target).hasClass("hide-password")) {
            hidePassword($(target));
        }
    })
});

/**
 * Show password when button clicked.
 * @param e target
 */
function showPassword(e) {
    e.removeClass("show-password").addClass("hide-password");
    e.text("Hide");
    $("#password").attr("type", "text");
}

/**
 * Hide password when button clicked.
 * @param e target
 */
function hidePassword(e) {
    e.removeClass("hide-password").addClass("show-password");
    e.text("Show");
    $("#password").attr("type", "password");
}

/**
 * Set input box border color to red when a login fails.
 * @param e target
 */
function loginError(e) {
    $(".input-box").addClass("error");
}

/**
 * Check if a username is formatted correctly.
 * @param username
 * @returns {boolean}
 */
function checkUsername(username) {
    return /^[A-Za-z0-9._]*$/.test(username);
}

/**
 * Check if an email address is formatted correctly.
 * @param email
 * @returns {boolean}
 */
function checkEmail(email) {
    return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

/*
$(function () {
    $("#username_email").blur(function (e) {
        if (!checkUsername(e.val()) ||
            !checkEmail(e.val())) {
            e.addClass("error");
            alert("Invalid username")
        } else {
            e.removeClass("error");
        }
    })
}
*/

/**
 * Enable submit button when input fields are not empty anymore.
 */
$(function () {
    $("#submit-button").prop("disabled", true);
    $("input").keyup(function () {
        if ($("#username_email").val() &&
            $("#password").val()/* &&
            !$("#username_email").hasClass("error") &&
            !$("#password").hasClass("error")*/) {
            $("#submit-button").prop("disabled", false);
        } else {
            $("#submit-button").prop("disabled", true);
        }
    })
})

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
            url: "api_login.php",
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
