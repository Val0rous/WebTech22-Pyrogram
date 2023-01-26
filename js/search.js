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
            // resolve success callback
            response => {
                const jsonData = JSON.parse(response);

                // success
                // redirect to
                if (jsonData.success === 1) {
                    location.href = ".php";
                } else {
                    alert("");
                }
            },
            // reject/failure callback
            function () {
                alert("There was some error!");
            }
        );
    });
});*/