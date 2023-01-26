/**
 * Toggle between follow and unfollow user.
 */
$(function () {
    $("button.follow, button.following").click(function (e) {
        e.preventDefault();
        const target = e.currentTarget;
        let user;
        if ($(target).hasClass("notifications")) {
            user = $(target).parent().find($("p > strong")).text();
        } else if ($(target).hasClass("search")) {
            user = $(target).parent().find($("section > p")).first().text();
            console.log(user);
        } else if ($(target).hasClass("user_profile")) {
            user = $(target).parent().parent().parent().find($("div.top-bar > h1")).text();
            console.log(user);
        }
        if ($(target).hasClass("follow")) {
            follow($(target), user);
        } else if ($(target).hasClass("following")) {
            unfollow($(target), user);
        }
    });
});

/**
 * Follow user when button clicked.
 * @param e target
 */
function follow(e, user) {
    $.ajax({
        type: "POST",
        url: "php/api_follow.php",
        data: {
            action: "follow",
            user: user
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
function unfollow(e, user) {
    $.ajax({
        type: "POST",
        url: "php/api_follow.php",
        data: {
            action: "unfollow",
            user: user
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
