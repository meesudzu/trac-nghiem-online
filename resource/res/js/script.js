$(document).ready(function() {
    $('.modal').modal();
    $('.collapsible').collapsible();
    $('select').select();
    $('#menu').on('click', function() {
        $('#menu-arrow-up').toggleClass('hide');
        $('#menu-arrow-down').toggleClass('hide');
    });
    $('#trigger-sidebar').on('click', function() {
        $('#sidebar-left').toggleClass('sidebar-show');
        $('#logout').toggleClass('sidebar-show');
        $('#box-content').toggleClass('box-content-mini');
        $('#footer').toggleClass('footer-mini');
    });
});

function submit_login() {
    $('#loading').css('display', 'inline');
    var url = "index.php?action=submit_login";
    var data = {
        username: $("#username").val()
    };
    var success = function(result) {
        reg = new RegExp('.+success.+');
        if (reg.test(result)) {
            $('#password').css('display', 'inline');
            $('#lbl_pw').css('display', 'inline');
            $('#username').css('display', 'none');
            $('#lbl_usr').css('display', 'none');
            $('#btn-login').html("Tiếp Tục").css('width', '100%').attr('onclick', 'submit_password()');
            $('#btn-fotgot').css('display', 'none');
            $('#loading').css('display', 'none');
        } else
            $('#loading').css('display', 'none');
        $('#st').append(result);
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
        reg = new RegExp('.+success.+');
        if (reg.test(result)) {
            setTimeout(function() {
                location.reload();
            }, 1500);
        }
        $('#loading').css('display', 'none');
        $('#st').append(result);
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
        $('#loading').css('display', 'none');
        $('#st').append(result);
    };
    $.post(url, data, success);
}