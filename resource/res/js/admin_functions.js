$(document).ready(function() {
    show_admins_panel();
    $('.modal').modal();
    $('.collapsible').collapsible();
    $('select').select();
    $('#trigger-sidebar').on('click', function() {
        $('#sidebar-left').toggleClass('sidebar-show');
        $('#logout').toggleClass('sidebar-show');
        $('#box-content').toggleClass('box-content-mini');
        $('#footer').toggleClass('footer-mini');
    });
    $('#menu').on('click', function() {
        $('#menu-arrow-up').toggleClass('hide');
        $('#menu-arrow-down').toggleClass('hide');
    });
    $('#btn-logout').on('click', function() {
        logout();
    });
    $("form").on('submit', function(event) {
        event.preventDefault();
    });

});

function show_profiles() {
    var url = "index.php?action=show_profiles";
    var success = function(result) {
        $('#box-content').html(result);
        $('select').select();
        $("form").on('submit', function(event) {
            event.preventDefault();
        });
    };
    $.get(url, success);
}

function show_admins_panel() {
    var url = "index.php?action=show_admins_panel";
    var success = function(result) {
        $('#box-content').html(result);
        $("form").on('submit', function(event) {
            event.preventDefault();
        });
    };
    $.get(url, success);
}

function show_teachers_panel() {
    var url = "index.php?action=show_teachers_panel";
    var success = function(result) {
        $('#box-content').html(result);
        $("form").on('submit', function(event) {
            event.preventDefault();
        });
    };
    $.get(url, success);
}

function show_students_panel() {
    var url = "index.php?action=show_students_panel";
    var success = function(result) {
        $('#box-content').html(result);
        $("form").on('submit', function(event) {
            event.preventDefault();
        });
    };
    $.get(url, success);
}

function show_classes_panel() {
    var url = "index.php?action=show_classes_panel";
    var success = function(result) {
        $('#box-content').html(result);
        $("form").on('submit', function(event) {
            event.preventDefault();
        });
    };
    $.get(url, success);
}

function show_questions_panel() {
    var url = "index.php?action=show_questions_panel";
    var success = function(result) {
        $('#box-content').html(result);
        $("form").on('submit', function(event) {
            event.preventDefault();
        });
    };
    $.get(url, success);
}

function show_units_panel() {
    var url = "index.php?action=show_units_panel";
    var success = function(result) {
        $('#box-content').html(result);
        $("form").on('submit', function(event) {
            event.preventDefault();
        });
    };
    $.get(url, success);
}

function show_notifications_panel() {
    var url = "index.php?action=show_notifications_panel";
    var success = function(result) {
        $('#box-content').html(result);
        $("form").on('submit', function(event) {
            event.preventDefault();
        });
    };
    $.get(url, success);
}

function show_about() {
    var url = "index.php?action=show_about";
    var success = function(result) {
        $('#box-content').html(result);
        $("form").on('submit', function(event) {
            event.preventDefault();
        });
    };
    $.get(url, success);
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

function valid_username_or_email(value, elem) {
    var url = "index.php?action=valid_username_or_email";
    var data = {
        usr_or_email: value
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        if (json_data.status) {
            $('#valid-' + elem + '-true').removeClass('hidden');
            $('#valid-' + elem + '-false').addClass('hidden');
        } else {
            $('#valid-' + elem + '-false').removeClass('hidden');
            $('#valid-' + elem + '-true').addClass('hidden');
        }
    };
    $.get(url, data, success);
}


function select_teacher() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_teachers";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=teacher_id]');
        sl.empty();
        $.each(json_data, function(key, value) {
            sl.append('<option value="' + value.teacher_id + '">' + value.name + '</option>');
        });
        $('select').select();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function select_grade() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_grades";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=grade_id]');
        sl.empty();
        $.each(json_data, function(key, value) {
            sl.append('<option value="' + value.grade_id + '">' + value.detail + '</option>');
        });
        $('select').select();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function select_unit() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_units";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=unit]');
        sl.empty();
        $.each(json_data, function(key, value) {
            sl.append('<option value="' + value.unit + '">' + value.detail + '</option>');
        });
        $('select').select();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function select_class(data) {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_classes";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=class_id]');
        sl.empty();
        $.each(json_data, function(key, value) {
            sl.append('<option value="' + value.class_id + '">' + value.class_name + '</option>');
        });
        $('select').select();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function select_status() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_statuses";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=status_id]');
        sl.empty();
        $.each(json_data, function(key, value) {
            sl.append('<option value="' + value.status_id + '">' + value.detail + '</option>');
        });
        $('select').select();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function valid_class_name(value) {
    var url = "index.php?action=valid_class_name";
    var data = {
        class_name: value
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        if (json_data.status) {
            $('#valid-class-true').removeClass('hidden');
            $('#valid-class-false').addClass('hidden');
        } else {
            $('#valid-class-false').removeClass('hidden');
            $('#valid-class-true').addClass('hidden');
        }
    };
    $.get(url, data, success);
}

function valid_email_on_profiles(data) {
    var new_email = $('#profiles-new-email').val();
    var current_email = $('#profiles-current-email').val();
    var url = "index.php?action=valid_email_on_profiles";
    var data1 = {
        new_email: new_email,
        current_email: current_email
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        if (json_data.status) {
            $('#valid-email-true').removeClass('hidden');
            $('#valid-email-false').addClass('hidden');
        } else {
            $('#valid-email-false').removeClass('hidden');
            $('#valid-email-true').addClass('hidden');
        }
    };
    $.post(url, data1, success);
}