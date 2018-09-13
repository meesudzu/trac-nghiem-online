$(document).ready(function() {
    show_index();
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

function show_about() {
    var url = "index.php?action=show_about";
    var success = function(result) {
        $('#box-content').html(result);
    };
    $.get(url, success);
}

function show_index() {
    var url = "index.php?action=show_index";
    var success = function(result) {
        $('#box-content').html(result);
        get_list_classes();
    };
    $.get(url, success);
}

function show_class_detail(ID) {
    var url = "index.php?action=show_class_detail";
    var success = function(result) {
        $('#box-content').html(result);
        get_class_detail(ID);
    };
    $.get(url, success);
}

function show_notifications() {
    var url = "index.php?action=show_notifications";
    var success = function(result) {
        $('#box-content').html(result);
    };
    $.get(url, success);
}

function get_class_detail(ID) {
    var url = "index.php?action=get_class_detail";
    var data = {
        ID: ID
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        insert_class_detail(json_data);
    };
    $.post(url, data, success);
}

function insert_class_detail(data) {
    var list = $('#class_detail');
    $('#class_name_detail').text(data[0].class_name);
    $.each(data, function(key, value) {
        var tr = $('<tr question="fadeIn" id="student-id-' + value.student_id + '"></tr>');
        tr.append('<td>' + value.student_id + '</td>');
        tr.append('<td><img src="../res/img/avatar/' + value.avatar + '"" alt="avatar" class="avatar" /></td>');
        tr.append('<td>' + value.username + '</td>');
        tr.append('<td>' + value.name + '</td>');
        tr.append('<td>' + value.birthday + '</td>');
        tr.append('<td>' + value.gender_detail + '</td>');
        tr.append('<td>' + value.last_login + '</td>');
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
        }
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
        sidebar.append('<a class="menu-list cursor" onclick="show_class_detail(' + value.class_id + ')">' + value.class_name + '</a>');
        list.append(tr);
    });
}

function view_btn(data) {
    return '<button class="btn" onclick="show_class_detail(' + data + ')">Xem</button>';
}