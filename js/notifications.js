/**
 * Toggle between follow and unfollow user.
 */
$(function () {
    $("button.follow, button.following").click(function (e) {
        e.preventDefault();
        const target = e.currentTarget;
        if($(target).hasClass("follow")) {
            follow($(target));
        } else if ($(target).hasClass("following")) {
            unfollow($(target));
        }
    });
});

/**
 * Follow user when button clicked.
 * @param e target
 */
function follow(e) {
    $.ajax({
        type: "POST",
        url: "php/api_follow.php",
        data: {
            action: "follow",
            user: e.parent().find($("p > strong")).text()
        }
    }).then(
        //resolve success callback
        response => {
            const jsonData = JSON.parse(response);

            //user has been followed successfully in the back-end
            if (jsonData.success === 1) {
                e.removeClass("follow").addClass("following");
                e.text("Following");
            } else {
                alert("Couldn't follow user!");
            }
        },
        //reject/failure callback
        function () {
            alert("There was some error!");
        }
    );
}

/**
 * Unfollow user when button clicked.
 * @param e target
 */
function unfollow(e) {
    $.ajax({
        type: "POST",
        url: "php/api_follow.php",
        data: {
            action: "unfollow",
            user: e.parent().find($("p > strong")).text()
        }
    }).then(
        //resolve success callback
        response => {
            const jsonData = JSON.parse(response);

            //user has been unfollowed successfully in the back-end
            if (jsonData.success === 1) {
                e.removeClass("following").addClass("follow");
                e.text("Follow");
            } else {
                alert("Couldn't unfollow user!");
            }
        },
        //reject/failure callback
        function () {
            alert("There was some error!");
        }
    );
}