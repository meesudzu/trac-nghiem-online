$(document).ready(function() {
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

});

$(function() {
    get_list_admins();
    $('#add_admin_form').on('submit', function() {
        submit_add_admin($('#add_admin_form').serialize());
        $('#add_admin_form')[0].reset();
    });
});

function get_list_admins() {
    var url = "index.php?action=get_list_admins";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_admins(json_data);
        $('.modal').modal();
        $('select').select();
    };
    $.get(url, success);
}

function show_list_admins(data) {
    var list = $('#list_admins');
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="fadeIn" id="admin-' + data[i].admin_id + '"></tr>');
        tr.append('<td class="">' + data[i].admin_id + '</td>');
        tr.append('<td class=""><img src="../res/img/avatar/' + data[i].avatar + '" alt="avatar" class="avatar" /></td>');
        tr.append('<td class="">' + data[i].name + '</td>');
        tr.append('<td class="">' + data[i].username + '</td>');
        tr.append('<td class="">' + data[i].email + '</td>');
        tr.append('<td class="">' + data[i].gender_detail + '</td>');
        tr.append('<td class="">' + data[i].birthday + '</td>');
        tr.append('<td class="">' + data[i].last_login + '</td>');
        tr.append('<td class="">' + admin_edit_button(data[i]) + '<br />' + admin_del_button(data[i]) + '</td>');
        list.append(tr);
    };
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function admin_edit_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="#edit-' + data.admin_id + '">Sửa</a>' +
        '<div id="edit-' + data.admin_id + '" class="modal modal-edit">' +
        '<div class="row col l12">' +
        '<form action="" method="POST" role="form" onsubmit="submit_edit_admin(this.id)" id="form-edit-admin-' + data.admin_id + '">' +
        '<div class="modal-content"><h5>Sửa Thông Tin Admin: ' + data.name + '</h5>' +
        '<div class="modal-body">' +
        '<div class="col l6 s12">' +
        '<div class="input-field">' +
        '<input type="hidden" value="' + data.admin_id + '" name="admin_id">' +
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

function admin_del_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" href="#del-' + data.admin_id + '">Xóa</a>' +
        '<div id="del-' + data.admin_id + '" class="modal"><div class="modal-content">' +
        '<h5>Cảnh Báo</h5><p>Xác nhận xóa tài khoản ' + data.username + '</p></div>' +
        '<form action="" method="POST" role="form" onsubmit="submit_del_admin(this.id)" id="form-del-admin-' + data.admin_id + '">' +
        '<div class="modal-footer"><a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a>' +
        '<input type="hidden" value="' + data.admin_id + '" name="admin_id">' +
        '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button></div></form></div>';
}

function submit_add_admin(data) {
    var url = "index.php?action=check_add_admin";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            admin_insert_data(json_data);
            $('.modal').modal();
            $('select').select();
        }
    };
    $.post(url, data, success);
}

function submit_del_admin(data) {
    data = $('#' + data).serializeArray();
    var url = "index.php?action=check_del_admin";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#admin-' + json_data.admin_id).hide('400', function() {
                this.remove();
            });
        }
    };
    $.post(url, data, success);
}

function submit_edit_admin(data) {
    form = $('#' + data);
    data = $('#' + data).serializeArray();
    var url = "index.php?action=check_edit_admin";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#admin-' + json_data.admin_id).remove();
            admin_insert_data(json_data);
            form[0].reset();
            $('.modal').modal();
            $('select').select();
        }
    };
    $.post(url, data, success);
}

function admin_insert_data(data) {
    var list = $('#list_admins');
    var tr = $('<tr class="fadeIn" id="admin-' + data.admin_id + '"></tr>');
    tr.append('<td class="">' + data.admin_id + '</td>');
    tr.append('<td class=""><img src="../res/img/avatar/' + data.avatar + '" alt="avatar" class="avatar" /></td>');
    tr.append('<td class="">' + data.name + '</td>');
    tr.append('<td class="">' + data.username + '</td>');
    tr.append('<td class="">' + data.email + '</td>');
    tr.append('<td class="">' + data.gender_detail + '</td>');
    tr.append('<td class="">' + data.birthday + '</td>');
    tr.append('<td class="">' + data.last_login + '</td>');
    tr.append('<td class="">' + admin_edit_button(data) + '<br />' + admin_del_button(data) + '</td>');
    list.append(tr);
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function valid_username_or_email(value, elem) {
    var url = "index.php?action=valid_username_or_email";
    var data = {
        usr_or_email: value
    }
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