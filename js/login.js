/**
 * Toggle between show and hide password.
 */
$(function() {
    //$("#login-form > div:nth-child(3) > button").click(function(e) {
    $("button.show-password, button.hide-password").click(function(e) {
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
                    alert("Username/email or password not valid!");
                    loginError(e);
                }
            },
            //reject/failure callback
            function () {
                alert("There was some error!");
            }
        );

        /*
        $.post("api_login.php",
            $(this).serialize()
        ).then(
            //resolve success callback
            response => {
                const jsonData = JSON.parse(response);

                //user is logged in successfully in the back-end
                //let's redirect
                if (jsonData.success === 1) {
                    location.href = "home.php";
                } else {
                    alert("Invalid Credentials!");
                }
            },
            //reject/failure callback
            function() {
                alert("There was some error!");
            }
        );
        */

        //axios.post("api_login.php", formData).then(response => {
        /*
        axios({
            method: "POST",
            url: "api-login.php",
            data: $(this).serialize()
        }).then(response => {
            console.log(response);
            //const jsonData = JSON.parse(response.data);

            //user is logged in successfully in the back-end
            //let's redirect
            if (response.data.success === 1) {
                location.href = "create.php";
            } else {
                alert("Invalid Credentials!");
            }
        }).catch(error => {
            alert("There was some error!");
        })
        */
    });
});