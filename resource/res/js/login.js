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