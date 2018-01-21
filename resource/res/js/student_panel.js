$(function() {
    get_list_students();
    select_class();
    $('#add_student_form').on('submit', function() {
        submit_add_student($('#add_student_form').serializeArray());
        $('#add_student_form')[0].reset();
    });
});

function get_list_students() {
    var url = "index.php?action=get_list_students";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_students(json_data);
        $('.modal').modal();
        $('select').select();
    };
    $.get(url, success);
}

function show_list_students(data) {
    var list = $('#list_students');
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="fadeIn" id="student-' + data[i].student_id + '"></tr>');
        tr.append('<td class="">' + data[i].student_id + '</td>');
        tr.append('<td class=""><img src="../res/img/avatar/' + data[i].avatar + '" alt="avatar" class="avatar" /></td>');
        tr.append('<td class="">' + data[i].name + '</td>');
        tr.append('<td class="">' + data[i].username + '</td>');
        tr.append('<td class="">' + data[i].class_name + '</td>');
        tr.append('<td class="">' + data[i].email + '</td>');
        tr.append('<td class="">' + data[i].gender_detail + '</td>');
        tr.append('<td class="">' + data[i].birthday + '</td>');
        tr.append('<td class="">' + data[i].last_login + '</td>');
        tr.append('<td class="">' + student_edit_button(data[i]) + '<br />' + student_del_button(data[i]) + '</td>');
        list.append(tr);
    };
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function student_edit_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="#edit-' + data.student_id + '">Sửa</a>' +
    '<div id="edit-' + data.student_id + '" class="modal modal-edit">' +
    '<div class="row col l12">' +
    '<form action="" method="POST" role="form" onsubmit="submit_edit_student(this.id)" id="form-edit-student-' + data.student_id + '">' +
    '<div class="modal-content"><h5>Sửa Thông Tin Gíao Viên: ' + data.name + '</h5>' +
    '<div class="modal-body">' +
    '<div class="col l6 s12">' +
    '<div class="input-field">' +
    '<input type="hidden" value="' + data.student_id + '" name="student_id">' +
    '<input type="hidden" value="' + data.username + '" name="username">' +
    '<input type="text" value="' + data.name + '" name="name" required>' +
    '<label for="name" class="active">Tên</label>' +
    '</div>' +
    '<div class="input-field">' +
    '<input type="text" name="password" required>' +
    '<label for="password">Mật Khẩu</label>' +
    '</div>' +
    '</div>' +
    '<div class="col l6 s12">' +
    '<div class="input-field">' +
    '<select name="gender_id">' +
    '<option value="1" selected>Không Xác Định</option>' +
    '<option value="2">Nam</option>' +
    '<option value="3">Nữ</option>' +
    '</select>' +
    '<label>Giới Tính</label>' +
    '</div>' +
    '<div class="input-field">' +
    '<select name="class_id">' +
    '<option disabled selected>Chọn</option>' +
    '</select>' +
    '<label>Lớp</label>' +
    '</div>' +
    '<div class="input-field">' +
    '<input type="date" value="' + data.birthday + '" name="birthday" required>' +
    '<label for="birthday" class="active">Ngày Sinh</label>' +
    '</div>' +
    '</div>' +
    '</div></div>' +
    '<div class="modal-footer">' +
    '<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trở Lại</a>' +
    '<button type="submit" class="waves-effect waves-green btn-flat">Đồng Ý</button>' +
    '</div></form></div></div>';
}

function student_del_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" href="#del-' + data.student_id + '">Xóa</a>' +
    '<div id="del-' + data.student_id + '" class="modal"><div class="modal-content">' +
    '<h5>Cảnh Báo</h5><p>Xác nhận xóa tài khoản ' + data.username + '</p></div>' +
    '<form action="" method="POST" role="form" onsubmit="submit_del_student(this.id)" id="form-del-student-' + data.student_id + '">' +
    '<div class="modal-footer"><a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a>' +
    '<input type="hidden" value="' + data.student_id + '" name="student_id">' +
    '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button></div></form></div>';
}

function submit_add_student(data) {
    var url = "index.php?action=check_add_student";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            student_insert_data(json_data);
            $('.modal').modal();
            $('select').select();
        }
    };
    $.post(url, data, success);
}

function submit_del_student(data) {
    data = $('#' + data).serializeArray();
    var url = "index.php?action=check_del_student";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#student-' + json_data.student_id).hide('400', function() {
                this.remove();
            });
        }
    };
    $.post(url, data, success);
}

function submit_edit_student(data) {
    form = $('#' + data);
    data = $('#' + data).serializeArray();
    var url = "index.php?action=check_edit_student";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#student-' + json_data.student_id).remove();
            student_insert_data(json_data);
            form[0].reset();
            $('.modal').modal();
            $('select').select();
        }
    };
    $.post(url, data, success);
}

function student_insert_data(data) {
    var list = $('#list_students');
    var tr = $('<tr class="fadeIn" id="student-' + data.student_id + '"></tr>');
    tr.append('<td class="">' + data.student_id + '</td>');
    tr.append('<td class=""><img src="../res/img/avatar/' + data.avatar + '" alt="avatar" class="avatar" /></td>');
    tr.append('<td class="">' + data.name + '</td>');
    tr.append('<td class="">' + data.username + '</td>');
    tr.append('<td class="">' + data.class_name + '</td>');
    tr.append('<td class="">' + data.email + '</td>');
    tr.append('<td class="">' + data.gender_detail + '</td>');
    tr.append('<td class="">' + data.birthday + '</td>');
    tr.append('<td class="">' + data.last_login + '</td>');
    tr.append('<td class="">' + student_edit_button(data) + '<br />' + student_del_button(data) + '</td>');
    list.append(tr);
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function select_class (data) {
    var url = "index.php?action=get_list_classes";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=class_id]');
        $.each(json_data, function(key, value) {
            sl.append('<option value="'+value.class_id+'">'+value.class_name+'</option>');
        });
        $('select').select();
    };
    $.get(url, success);
}