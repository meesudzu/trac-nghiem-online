$(document).ready(function() {
    get_list_tests();
    $('select').select();
    $('.modal').modal();
    $('#trigger-sidebar').on('click', function() {
        $('#sidebar-left').toggleClass('sidebar-show');
        $('#menu-icon').toggleClass('rot');
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

function get_url_parameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
}


function get_list_tests() {
    var url = "index.php?action=get_list_tests";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        insert_tests(json_data);
        $('.modal').modal();
        $("form.form_test").on('submit', function(event) {
            event.preventDefault();
            submit_test();
            this.reset();
        });
    };
    $.get(url, success);
}
function insert_tests(data) {
    var list = $('#tests_list');
    var url = "index.php?action=get_scores";
    var success = function(result) {
        var scores = $.parseJSON(result);
        $.each(data, function(key, value) {
            var tr = $('<div class="col l3 m4 s6 unit_detail" id="test-' + value.test_code + '"></div>');
            tr.append('<i>Tên: </i><span class="unit_status">' + value.test_name + '</span><br />');
            tr.append('<i>Môn: </i><span class="unit_status">' + value.subject_detail + '</span><br />');
            tr.append('<i>Khối: </i><span class="unit_status">' + value.grade + '</span><br />');
            tr.append('<i>Mã Đề: </i><span class="unit_status">' + value.test_code + '</span><br />');
            tr.append('<i>Số Câu Hỏi: </i><span class="unit_status">' + value.total_questions + '</span><br />');
            tr.append('<i>Thời Gian: </i><span class="unit_status"> ' + value.time_to_do + '</span> Phút<br />');
            tr.append('<i>Trạng Thái: </i><span class="unit_status"> ' + value.status + '</span><br />');
            tr.append('<i>Ghi Chú: </i><span class="unit_status">' + value.note + '</span><br />');
            if(value.status_id!=2) {
                var flag = false;
                $.each(scores, function(index, val) {
                    if(val.test_code == value.test_code) {
                        flag = true;
                        return false;
                    }
                });
                if(flag)
                    tr.append('<a href="index.php?action=show_result&test_code=' + value.test_code + '" class="btn">Chi Tiết Bài Làm</a>');
                else
                    tr.append(do_exam_button(value));
            }
            else
                tr.append('<a href="index.php?action=show_result&test_code=' + value.test_code + '" class="btn">Chi Tiết Bài Làm</a>');
            list.append(tr);
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
    }, 500);
    $('#status').delay(1000).animate({
        'opacity': '0',
        'height': '0',
        'line-height': '0px'
    }, 500);
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
                window.location.replace("index.php");
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

function do_exam_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="#do-test-' + data.test_code + '" id="do_test">Làm Bài</a>' +
    '<div id="do-test-' + data.test_code + '" class="modal">' +
    '<div class="row col l12">' +
    '<form class="form_test" action="" method="POST" role="form" id="form_submit_test_' + data.test_code + '">' +
    '<div class="modal-content"><h5>Nhập mật khẩu đề: ' + data.test_code + '</h5>' +
    '<div class="modal-body">' +
    '<div class="input-field">' +
    '<input type="hidden" value="' + data.test_code + '" name="test_code" id="test_code">' +
    '<input type="password" name="password" id="password" required>' +
    '<label for="password">Mật Khẩu</label>' +
    '</div>' +
    '</div>' +
    '</div><div class="col l12 s12">' +
    '<div class="modal-footer">' +
    '<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trở Lại</a>' +
    '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button>' +
    '</div></div></form></div></div>';
}

function submit_test() {
    $('#preload').removeClass('hidden');
    var test_code = $('#test_code').val();
    var password = $('#password').val();
    var data = {
        test_code:test_code,
        password:password
    }
    var url = "index.php?action=check_password";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            setTimeout(function() {
                location.reload();
            }, 1500);
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}