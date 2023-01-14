"use strict";

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

/**
 * Check if a password is formatted correctly.
 * @param password
 * @returns {boolean}
 */
function checkPassword(password) {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,128}$/.test(password);
}
