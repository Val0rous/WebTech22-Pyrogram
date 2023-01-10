$(document).ready(function() {
    $("#login-form > div:nth-child(3) > button").click(function(e) {
        const target = e.currentTarget;
        if ($(target).hasClass("show-password")) {
            showPassword($(target));
        } else if ($(target).hasClass("hide-password")) {
            hidePassword($(target));
        }
    })
});

function showPassword(e) {
    e.removeClass("show-password").addClass("hide-password");
    e.text("Hide");
    $("#password").attr("type", "text");
}

function hidePassword(e) {
    e.removeClass("hide-password").addClass("show-password");
    e.text("Show");
    $("#password").attr("type", "password");
}
/*
$(document).ready(function() {
    $("button.hide-password").click(function() {
        $("#password").attr("type", "password");
        $(this).classList.add("show-password");
        $(this).classList.remove("hide-password");
    })
});
*/

$(document).ready(function() {
    $("#login-form").submit(function(e) {
        e.preventDefault();

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
                    alert("Invalid Credentials!");
                }
            },
            //reject/failure callback
            function() {
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