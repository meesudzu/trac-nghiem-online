$(document).ready(function() {
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
});

/**
 * Call ajax to Controller_Login > submit_login()
 * click event in button #btn-login (res/templates/login.php)
 */

function submit_login() {
    $('#loading').removeClass('hidden');
    var url = "index.php?action=submit_login";
    var data = {
        username: $("#username").val()
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#field_username').css('display', 'none');
            $('#lbl_pw').removeClass('hidden');
            $('#password').removeClass('hidden');
            $('#hi').css('display', 'inline');
            $('#hi-text').text(""+ json_data.name +"");
            $('#btn-login').html("Tiếp Tục").css('width', '100%').attr('onclick', 'submit_password()');
            $('#btn-forgot').css('display', 'none');
            $('#reload').css('display', 'inline');
        }
        $('#loading').addClass('hidden');
    };
    $.post(url, data, success);
}

/**
 * Click event in button #reload (res/templates/login.php)
 */

function reload() {
    $('#reload').css('display', 'none');
    $('#field_username').css('display', 'inline');
    $('#hi').css('display', 'none');
    $('#lbl_pw').addClass('hidden');
    $('#password').addClass('hidden');
    $('#btn-login').html("Đăng Nhập").css('width', '49%').attr('onclick', 'submit_login()');
    $('#btn-forgot').css('display', 'inline');
}

/**
 * Call ajax to Controller_Login > submit_password()
 * Change onclick #btn-login in submit_login
 * Click event in button #btn-login (res/templates/login.php)
 */

function submit_password() {
    $('#loading').removeClass('hidden');
    var url = "index.php?action=submit_password";
    var data = {
        password: $("#password").val()
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            setTimeout(function() {
                location.reload('index.php');
            }, 1500);
        }
        $('#loading').addClass('hidden');
    };
    $.post(url, data, success);
}

/**
 * Call ajax to Controller_Login > submit_forgot_password()
 * click event in button #btn-forgot (res/templates/login.php)
 */

function submit_forgot_password() {
    $('#loading').removeClass('hidden');
    var url = "index.php?action=submit_forgot_password";
    var data = {
        username: $("#username").val()
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#loading').addClass('hidden');
    };
    $.post(url, data, success);
}

function show_status(json_data) {
    if (json_data.status) {
        $('#status').addClass('success');
        $('#status').removeClass('failed');
    } else {
        $('#status').addClass('failed');
        $('#status').removeClass('success');
    }
    $('#status').html(json_data.status_value);
    $('#status').animate({
        'height': '65',
        'line-height': '65px',
        'opacity': '1'
    }, 500);
    $('#status').delay(1000).animate({
        'opacity': '0',
        'height': '0',
        'line-height': '0px'
    }, 500);
}