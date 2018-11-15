$(document).ready(function() {
    $('select').select();
    $('.modal').modal();
    get_list_classes();
    $('.collapsible').collapsible();
    $('#trigger-sidebar').on('click', function() {
        $('#sidebar-left').toggleClass('sidebar-show');
        $('#menu-icon').toggleClass('rot');
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

function get_class_detail(ID) {
    var url = "index.php?action=get_class_detail";
    data = {
        ID:ID
    }
    var success = function(result) {
        var json_data = $.parseJSON(result);
        insert_class_detail(json_data);
    };
    $.get(url, data, success);
}

function insert_class_detail(data) {
    var list = $('#class_detail');
    $('#class_name_detail').text(data[0].class_name);
    $.each(data, function(key, value) {
        var tr = $('<tr id="student-id-' + value.student_id + '"></tr>');
        tr.append('<td>' + value.student_id + '</td>');
        tr.append('<td><img src="res/img/avatar/' + value.avatar + '"" alt="avatar" class="avatar" /></td>');
        tr.append('<td>' + value.username + '</td>');
        tr.append('<td>' + value.name + '</td>');
        if(value.birthday == '' || value.birthday == '0000-00-00')
            value.birthday = 'Chưa Xác Định';
        tr.append('<td>' + value.birthday + '</td>');
        tr.append('<td>' + value.gender_detail + '</td>');
        if(value.last_login == '' || value.last_login == '0000-00-00 00:00:00')
            value.last_login = 'Chưa Đăng Nhập';
        tr.append('<td>' + value.last_login + '</td>');
        tr.append('<td>' + view_score_btn(value) + '</td>');
        list.append(tr);
    });
    $('#table_classes_detail').DataTable( {
        "language": {
            "lengthMenu": "Hiển thị _MENU_",
            "zeroRecords": "Không tìm thấy",
            "info": "Hiển thị trang _PAGE_/_PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "emptyTable": "Không có dữ liệu",
            "infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
            "sSearch": "Tìm kiếm",
            "paginate": {
                "first":      "Đầu",
                "last":       "Cuối",
                "next":       "Sau",
                "previous":   "Trước"
            },
        },
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 7 ] }, //hide sort icon on header of column 7
        ]
    } );
    $('.modal').modal();
    $('select').select();
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

function get_list_classes() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_classes_by_teacher";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_classes(json_data);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_list_classes(data) {
    var list = $('#list_classes');
    list.empty();
    var sidebar = $('#list_classes_sidebar');
    sidebar.empty();
    $.each(data, function(key, value) {
        var tr = $('<tr question="fadeIn" id="class-id-' + value.class_id + '"></tr>');
        tr.append('<td>' + value.class_id + '</td>');
        tr.append('<td>' + value.class_name + '</td>');
        tr.append('<td>' + value.grade + '</td>');
        tr.append('<td>' + view_btn(value.class_id) + '</td>');
        sidebar.append('<a href="index.php?action=show_class_detail&class_id=' + value.class_id + '" class="menu-list cursor">' + value.class_name + '</a>');
        list.append(tr);
    });
}

function view_btn(data) {
    return '<a href="index.php?action=show_class_detail&class_id=' + data + '" class="btn">Xem</a>';
}

function view_score_btn(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" href="#view_score-' + data.student_id + '" onclick="get_score(' + data.student_id + ')">Chi Tiết</a>' +
    '<div id="view_score-' + data.student_id + '" class="modal"><div class="modal-content">' +
    '<h5>Chi tiết điểm học sinh </h5><span style="font-weight: bold; font-size: 1.2em">' + data.name + '</span></div>' +
    '<div class="modal-body" id="_score-' + data.student_id + '">' +
    '</div><div class="modal-footer"><a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a></div>' +
    '</div></div>';
}

function get_score(id) {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_score";
    var data = {
        student_id : id
    }
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var tbody = $('#_score-'+id);
        tbody.empty();
        if(json_data == '')
            var p = $('<p style="font-size: 1.3em; font-weight: bold;">Chưa có bài làm nào</p>');
            tbody.append(p);
        $.each(json_data, function(key, value) {
            var p = $('<p style="font-size: 1.3em; font-weight: bold;">Đề thi: ' + value.test_code + ' - ' + value.score_number + ' điểm.<br />Hoàn thành lúc ' + value.completion_time + '</p>');
            tbody.append(p);
        });
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}