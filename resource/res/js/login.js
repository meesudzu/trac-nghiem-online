$(document).ready(function() {
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
});

function submit_login() {
    $('#loading').css('display', 'inline');
    var url = "index.php?action=submit_login";
    var data = {
        username: $("#username").val()
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#field_username').remove();
            $('#lbl_pw').removeClass('hidden');
            $('#password').removeClass('hidden');
            $('#btn-login').html("Tiếp Tục").css('width', '100%').attr('onclick', 'submit_password()');
            $('#btn-fotgot').css('display', 'none');
        }
        $('#loading').css('display', 'none');
    };
    $.post(url, data, success);
}

function submit_password() {
    $('#loading').css('display', 'inline');
    var url = "index.php?action=submit_password";
    var data = {
        password: $("#password").val()
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            setTimeout(function() {
                location.reload();
            }, 1500);
        }
        $('#loading').css('display', 'none');
    };
    $.post(url, data, success);
}

function submit_forgot_password() {
    $('#loading').css('display', 'inline');
    var url = "index.php?action=submit_forgot_password";
    var data = {
        username: $("#username").val()
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#loading').css('display', 'none');
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
    }, 250);
    $('#status').delay(1000).animate({
        'opacity': '0',
        'height': '0',
        'line-height': '0px'
    }, 250);
}