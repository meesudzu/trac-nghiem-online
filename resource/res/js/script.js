get_profile();
$(document).ready(function() {
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
});

function get_profile() {
    var url = "index.php?action=get_profile";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        set_profile(json_data);
    };
    $.get(url, success);
}

function set_profile(data) {
    $('#profile-avatar').attr('src', '../res/img/avatar/' + data.avatar + '');
    $('#profile-name').text(data.name);
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

function logout() {
    var url = "index.php?action=logout";
    var data = {
        confirm: true
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            setTimeout(function() {
                location.reload();
            }, 1500);
        }
    };
    $.post(url, data, success);
}