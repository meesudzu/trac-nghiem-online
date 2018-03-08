$(document).ready(function() {
    show_index();
    $('.modal').modal();
    $('select').select();
    $('#trigger-sidebar').on('click', function() {
        $('#sidebar-left').toggleClass('sidebar-show');
        $('#logout').toggleClass('sidebar-show');
        $('#box-content').toggleClass('box-content-mini');
        $('#footer').toggleClass('footer-mini');
    });
    $('#btn-logout').on('click', function() {
        logout();
    });
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
});

function show_profiles() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=show_profiles";
    var success = function(result) {
        $('#box-content').html(result);
        $('select').select();
        $("form").on('submit', function(event) {
            event.preventDefault();
        });
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_about() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=show_about";
    var success = function(result) {
        $('#box-content').html(result);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_chat() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=show_chat";
    var success = function(result) {
        $('#box-content').html(result);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_notifications() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=show_notifications";
    var success = function(result) {
        $('#box-content').html(result);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_exam(unit_id) {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=show_exam";
    var success = function(result) {
        $('#box-content').html(result);
        $('#unit_id').text(unit_id);
        get_rand_questions(unit_id);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function get_rand_questions(unit_id) {
    var url = "index.php?action=get_rand_questions";
    var data = {
        unit : unit_id
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        if(json_data.status)
            insert_questions(json_data[0], unit_id);
        else
            insert_score(json_data[0]);
    };
    $.post(url, data, success);
}

function insert_score (data) {
    var list = $('#questions_list');
    list.append('<span class="exam_quest">Bài tập này đã làm!</span><br />');
    list.append('<span class="exam_quest">Điểm: </span><span class="exam_detail">'+ data.score +'</span><br />');
    list.append('<span class="exam_quest">Hoàn thành lúc: </span><span class="exam_detail">'+ data.completion_time +'</span><br />');
}

function insert_questions (data, unit) {
    var list = $('#questions_list');
    var i = 1;
    var ID = '<input value="'+ unit +'" name="unit" type="hidden" />';
    list.append(ID);
    $.each(data, function(key, value) {
        var data = '<span class="exam_quest">Câu '+ i +' <span class="exam_small">#'+ value.ID +'</span>: </span>'+
        '<span class="exam_detail">'+ value.question_detail +'</span>'+
        '<input type="hidden" name="quest_'+ i +'_id" value="'+ value.ID +'" />'+
        '<div class="exam_ans">'+
        '<label><input value="'+ value.answer_a +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" />'+
        '<span>'+ value.answer_a +'</span></label>'+
        '<label><input value="'+ value.answer_b +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" />'+
        '<span>'+ value.answer_b +'</span></label>'+
        '<label><input value="'+ value.answer_c +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" />'+
        '<span>'+ value.answer_c +'</span></label>'+
        '<label><input value="'+ value.answer_d +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" />'+
        '<span>'+ value.answer_d +'</span></label></div>';
        i++;
        list.append(data);
    });
    var btn = '<div class="send_exam"><button class="btn" type="reset">Làm Lại</button><button class="btn" type="submit">Nộp Bài</button></div>';
    list.append(btn);
}

function show_index() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=show_index";
    var success = function(result) {
        $('#box-content').html(result);
        get_units();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function get_units() {
    var url = "index.php?action=get_units";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        insert_units(json_data);
    };
    $.get(url, success);
}

function insert_units(data) {
    var list = $('#units_list');
    $.each(data, function(key, value) {
        var tr = $('<div class="col l3 s6 unit_detail" id="unit-' + value.unit + '"></div>');
        tr.append('<span class="unit_name">' + value.unit_detail + '</span>');
        tr.append('<i>Tình Trạng: </i><span class="unit_status"> ' + value.status_detail + '</span><br />');
        tr.append('<i>Đóng Lúc: </i><span class="unit_status"> ' + value.close_time + '</span><br /><br />');
        if(value.status_id!=2)
            tr.append('<button class="btn" onclick="show_exam('+ value.unit +')">Làm Bài</button>');
        else
            tr.append('<button class="btn" disabled>Làm Bài</button>');
        list.append(tr);
    });
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