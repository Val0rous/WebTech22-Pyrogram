/*const searchField = document.querySelector("#Search");
searchField.addEventListener("keyup", function (e) {
    console.log(searchField.value);
    /*document.querySelector("body > main > main").innerHTML += `
    <?php require("templates/search_results.php/?search=${searchField.value}");?>`;*/
    /*document.querySelector("main > form").submit();
});*/

/*$(function() {
    $("main > form").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "templates/search.php",
            data: $(this).serialize()
        })/*.then(
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
});*/