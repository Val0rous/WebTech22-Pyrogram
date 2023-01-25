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

//let current_slide = 0;
let slideshows = [];

/**
 * Slideshow setup: hide all images in carousel but the first one,
 * and create an object to log current image for each carousel.
 * Only iterates on posts having more than one image (basically, albums),
 * as it would be pointless to check those having a single image.
 */
$(function () {
    $("body > main > article > main > div.slideshow-container").each(function (i, obj) {
        let item = {
            slideshow: $(obj).parent(),
            current_slide: 0
        };
        slideshows.push(item);
        showSlide($(obj).parent(), 0);
    });
});

/**
 * Hide all images except for the current one
 * @param target main tag of target post
 * @param index slide index
 * @returns {number} current index
 */
function showSlide(target, index) {
    let slides = target.find(".slideshow");
    let dots = target.find(".dot");
    if (index >= slides.length) {
        index = slides.length - 1;
    }
    if (index < 0) {
        index = 0;
    }
    slides.each(function (i, obj) {
        $(obj).css("display", "none");
        if (i === index) {
            $(obj).css("display", "block");
        }
    });
    dots.each(function (i, obj) {
        $(obj).removeClass("active");
        if (i === index) {
            $(obj).addClass("active");
        }
    });
    return index;
}

/**
 * Click on previous or next arrows to slide images to the previous or next one.
 */
$(function () {
    $("a.prev, a.next").click(function (e) {
        //e.preventDefault();
        const target = e.currentTarget;
        if ($(target).hasClass("next")) {
            nextSlide($(target).parent().parent(),1);
        } else if ($(target).hasClass("prev")) {
            nextSlide($(target).parent().parent(),-1);
        }
    });
});

/**
 * Go to next or previous slide.
 * @param target main tag of target post
 * @param increment 1 for next slide, -1 for previous slide
 */
function nextSlide(target, increment) {
    let slides = slideshows.find(item => item.slideshow[0] === target[0]);
    slides.current_slide = showSlide(target, slides.current_slide += increment);
}

/**
 * Click on the dots to select the specific image you want to view.
 */
$(function () {
    $(".dot").click(function (e) {
        //e.preventDefault();
        const target = e.currentTarget;
        switchSlide($(target).parent().parent(), $(target).attr("value"));
    });
});

/**
 * Switch slide to the desired one.
 * @param target main tag of target post
 * @param index slide index
 */
function switchSlide(target, index) {
    let slides = slideshows.find(item => item.slideshow[0] === target[0]);
    //no need to re-assign slideshows.current_slide again, as I did before
    showSlide(target, slides.current_slide = index);
}
