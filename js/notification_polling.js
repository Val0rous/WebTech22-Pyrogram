function notifications() {
    $.ajax({
        type: "POST",
        url: "php/api_notifications.php"
    }).then(
        //resolve success callback
        response => {
            const jsonData = JSON.parse(response);

            if (jsonData.newNotifications > 0) {
                $("div.navigation > nav > a.notifications > div.notification-number > span").text(jsonData.newNotifications);
                $("div.navigation > nav > a.notifications > div.notification-number").removeClass("hidden");
            } else {
                $("div.navigation > nav > a.notifications > div.notification-number").addClass("hidden");
                $("div.navigation > nav > a.notifications > div.notification-number > span").text("");
            }
        },
        //reject/failure callback
        function () {
            console.log("An error occurred: couldn't check for new notifications!")
        }
    );


    setTimeout(notifications, 15000);
}

$(window).on("load", notifications);
