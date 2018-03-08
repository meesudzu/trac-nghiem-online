$(function() {
    get_list_teachers();
    $('#add_teacher_form').on('submit', function() {
        submit_add_teacher($('#add_teacher_form').serializeArray());
        $('#add_teacher_form')[0].reset();
    });
});

function get_list_teachers() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_teachers";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_teachers(json_data);
        $('.modal').modal();
        $('select').select();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_list_teachers(data) {
    var list = $('#list_teachers');
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="fadeIn" id="teacher-' + data[i].teacher_id + '"></tr>');
        tr.append('<td class="">' + data[i].teacher_id + '</td>');
        tr.append('<td class=""><img src="../res/img/avatar/' + data[i].avatar + '" alt="avatar" class="avatar" /></td>');
        tr.append('<td class="">' + data[i].name + '</td>');
        tr.append('<td class="">' + data[i].username + '</td>');
        tr.append('<td class="">' + data[i].email + '</td>');
        tr.append('<td class="">' + data[i].gender_detail + '</td>');
        tr.append('<td class="">' + data[i].birthday + '</td>');
        tr.append('<td class="">' + data[i].last_login + '</td>');
        tr.append('<td class="">' + teacher_edit_button(data[i]) + '<br />' + teacher_del_button(data[i]) + '</td>');
        list.append(tr);
    }
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function teacher_edit_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="#edit-' + data.teacher_id + '">Sửa</a>' +
        '<div id="edit-' + data.teacher_id + '" class="modal modal-edit">' +
        '<div class="row col l12">' +
        '<form action="" method="POST" role="form" id="form-edit-teacher-' + data.teacher_id + '">' +
        '<div class="modal-content"><h5>Sửa: ' + data.name + '</h5>' +
        '<div class="modal-body">' +
        '<div class="col l6 s12">' +
        '<div class="input-field">' +
        '<input type="hidden" value="' + data.teacher_id + '" name="teacher_id">' +
        '<input type="hidden" value="' + data.username + '" name="username">' +
        '<input type="text" value="' + data.name + '" name="name" required>' +
        '<label for="name" class="active">Tên</label>' +
        '</div>' +
        '<div class="input-field">' +
        '<input type="password" name="password" required>' +
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
        '<input type="date" value="' + data.birthday + '" name="birthday" required>' +
        '<label for="birthday" class="active">Ngày Sinh</label>' +
        '</div>' +
        '</div>' +
        '</div></div>' +
        '</div><div class="col l12 s12">' +
        '<div class="modal-footer">' +
        '<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trở Lại</a>' +
        '<button type="submit" class="waves-effect waves-green btn-flat" onclick="submit_edit_teacher(' + data.teacher_id + ')">Đồng Ý</button>' +
        '</div></div></form></div></div>';
}

function teacher_del_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" href="#del-' + data.teacher_id + '">Xóa</a>' +
        '<div id="del-' + data.teacher_id + '" class="modal"><div class="modal-content">' +
        '<h5>Cảnh Báo</h5><p>Xác nhận xóa tài khoản ' + data.username + '</p></div>' +
        '<form action="" method="POST" role="form" onsubmit="submit_del_teacher(this.id)" id="form-del-teacher-' + data.teacher_id + '">' +
        '<div class="modal-footer"><a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a>' +
        '<input type="hidden" value="' + data.teacher_id + '" name="teacher_id">' +
        '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button></div></form></div>';
}

function submit_add_teacher(data) {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=check_add_teacher";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            teacher_insert_data(json_data);
            $('.modal').modal();
            $('select').select();
            $('#preload').addClass('hidden');
        }
    };
    $.post(url, data, success);
}

function submit_del_teacher(data) {
    $('#preload').removeClass('hidden');
    data = $('#' + data).serializeArray();
    var url = "index.php?action=check_del_teacher";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#teacher-' + json_data.teacher_id).hide('fast', function() {
                this.remove();
            });
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function submit_edit_teacher(data) {
    $('#preload').removeClass('hidden');
    form = $('#form-edit-teacher-' + data);
    data = $('#form-edit-teacher-' + data).serializeArray();
    var url = "index.php?action=check_edit_teacher";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#teacher-' + json_data.teacher_id).remove();
            teacher_insert_data(json_data);
            form[0].reset();
            $('.modal').modal();
            $('select').select();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function teacher_insert_data(data) {
    var list = $('#list_teachers');
    var tr = $('<tr class="fadeIn" id="teacher-' + data.teacher_id + '"></tr>');
    tr.append('<td class="">' + data.teacher_id + '</td>');
    tr.append('<td class=""><img src="../res/img/avatar/' + data.avatar + '" alt="avatar" class="avatar" /></td>');
    tr.append('<td class="">' + data.name + '</td>');
    tr.append('<td class="">' + data.username + '</td>');
    tr.append('<td class="">' + data.email + '</td>');
    tr.append('<td class="">' + data.gender_detail + '</td>');
    tr.append('<td class="">' + data.birthday + '</td>');
    tr.append('<td class="">' + data.last_login + '</td>');
    tr.append('<td class="">' + teacher_edit_button(data) + '<br />' + teacher_del_button(data) + '</td>');
    list.append(tr);
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}