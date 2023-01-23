/**
 * Toggle between like and unlike post.
 */
$(function () {
    $("button.like").click(function (e) {
        e.preventDefault();
        const target = e.currentTarget;
        if (!$(target).hasClass("liked")) {
            like($(target));
        } else if ($(target).hasClass("liked")) {
            unlike($(target));
        }
    });
});

/**
 * Like post when button clicked.
 * @param e target
 */
function like(e) {
    $.ajax({
        type: "POST",
        url: "php/api_like.php",
        data: {
            action: "like",
            post: e.parent().parent().find($("header > div.post-id")).text()
        }
    }).then(
        //resolve success callback
        response => {
            const jsonData = JSON.parse(response);

            //post has been successfully liked in the back-end
            if (jsonData.success === 1) {
                e.addClass("liked");
                e.find($("div")).text(jsonData.numLikes);
            } else {
                alert("Couldn't like post!");
            }
        },
        //reject/failure callback
        function () {
            alert("There was some error!");
        }
    );
}

/**
 * Unlike post when button clicked.
 * @param e target
 */
function unlike(e) {
    $.ajax({
        type: "POST",
        url: "php/api_like.php",
        data: {
            action: "unlike",
            post: e.parent().parent().find($("header > div.post-id")).text()
        }
    }).then(
        //resolve success callback
        response => {
            const jsonData = JSON.parse(response);

            //post has been successfully liked in the back-end
            if (jsonData.success === 1) {
                e.removeClass("liked");
                e.find($("div")).text(jsonData.numLikes);
            } else {
                alert("Couldn't like post!");
            }
        },
        //reject/failure callback
        function () {
            alert("There was some error!");
        }
    );
}
