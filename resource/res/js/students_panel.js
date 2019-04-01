$(function() {
    get_list_students();
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
    select_class();
    $('.tabs').tabs();
    $('#add_student_form').on('submit', function() {
        submit_add_student($('#add_student_form').serializeArray());
        $('#add_student_form')[0].reset();
    });
    $('#add_via_file').on('submit', function() {
        $('#preload').removeClass('hidden');
        submit_add_student_via_file();
        $('#add_via_file')[0].reset();
        $('#preload').addClass('hidden');
    });
    $('#select_all').on('change', function() {
        if (this.checked) {
            $('.checkbox').each(function() {
                this.checked = true;
            });
            $('#select_action').removeClass('hidden');
        } else {
            $('.checkbox').each(function() {
                this.checked = false;
            });
            $('#select_action').addClass('hidden');
        }
    });
    $('table').on('click', 'a.modal-trigger', function() {
        $('select').select();
        select_class();
        var elem = document.querySelector(this.id);
        var instance = M.Modal.init(elem);
        var instance = M.Modal.getInstance(elem);
        instance.open();
    });
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
});

function check_box() {
    $('#select_action').removeClass('hidden');
    if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('#select_all').prop('checked', true);
    } else {
        $('#select_all').prop('checked', false);
    }
    if ($('.checkbox:checked').length == 0) {
        $('#select_action').addClass('hidden');
    }
}

function delete_check() {
    var _list_check = '';
    $('.checkbox:checked').each(function() {
        _list_check += this.value + ','
    });
    data = {
        list_check: _list_check
    }
    $('#preload').removeClass('hidden');
    var url = "index.php?action=delete_check_students";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#table_students').DataTable().ajax.reload();
        $('#select_all').prop('checked', false);
        $('#select_action').addClass('hidden');
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);

}

function get_list_students() {
    $('#table_students').DataTable( {
        "sPaginationType" : "full_numbers",
        "processing": true,
        "serverSide": true,
        "ajax": {
            url :"index.php?action=list_students",
            type: "post",
            error: function(res){
                console.log("Error");
            }
        },
        "columns": [
        {
            "data": "student_id",
            "title": '<p><label><input type="checkbox" id="select_all" /><span></span></label></p>'
        },
        {
            "data": "student_id",
            "title": "ID"
        },
        {
            "data": "avatar",
            "title": "Avatar"
        },
        {
            "data": "name",
            "title": "Tên"
        },
        {
            "data": "username",
            "title": "Mã Học Sinh"
        },
        {
            "data": "class_name",
            "title": "Lớp"
        },
        {
            "data": "email",
            "title": "Email"
        },
        {
            "data": "gender_detail",
            "title": "Giớp Tính"
        },
        {
            "data": "birthday",
            "title": "Ngày Sinh"
        },
        {
            "data": "last_login",
            "title": "Online Cuối"
        },
        {
            "data": "student_id",
            "title": '<i class="material-icons">settings</i>'
        }
        ],
        "columnDefs":[
        {
            "targets":0,
            "render": function(data) 
            {
                return '<p><label><input type="checkbox" name="checkbox_students" class="checkbox" onchange="check_box();" value="' + data + '" /><span></span></label></p>'
            }
        },
        {
            "targets":2,
            "render": function(data) 
            {
                return '<img src="upload/avatar/' + data + '" alt="avatar" class="avatar" />';
            }
        },
        {
            "targets":8,
            "render": function(data) 
            {
                if (data == '' || data == '0000-00-00')
                    return 'Chưa Xác Định';
                else
                    return data;
            }
        },
        {
            "targets":9,
            "render": function(data) 
            {
                if (data == '' || data == '0000-00-00 00:00:00')
                    return 'Chưa Đăng Nhập';
                else
                    return data;
            }
        },
        {
            "targets":10,
            "render": function(data, type, meta) 
            {
                var button = student_edit_button(meta) + '<br />' + student_del_button(meta);
                $("form").on('submit', function(event) {
                    event.preventDefault();
                });
                return button;
            }
        },
        {
            "bSortable": false,
            "aTargets": [0, 2, 10]
        },
        ],
        'aaSorting': [
        [1, 'asc']
        ],
        "language": {
            "lengthMenu": "Hiển thị _MENU_",
            "zeroRecords": "Không tìm thấy",
            "info": "Hiển thị trang _PAGE_/_PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "emptyTable": "Không có dữ liệu",
            "infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
            "sSearch": "Tìm kiếm",
            "processing": "Đang tải!",
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Sau",
                "previous": "Trước"
            },
        }
    } );
    $('.modal').modal();
    $('select').select();
    $('body').attr('style', 'overflow: auto;');
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function student_edit_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="#edit-' + data.student_id + '" id="#edit-' + data.student_id + '">Sửa</a>' +
    '<div id="edit-' + data.student_id + '" class="modal modal-edit">' +
    '<div class="row col l12">' +
    '<form action="" method="POST" role="form" id="form-edit-student-' + data.student_id + '">' +
    '<div class="modal-content"><h5>Sửa: ' + data.name + '</h5>' +
    '<div class="modal-body">' +
    '<div class="col l6 s12">' +
    '<div class="input-field">' +
    '<input type="hidden" value="' + data.student_id + '" name="student_id">' +
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
    '<select name="class_id" onchange="test(this.value)">' +
    '</select>' +
    '<label>Lớp</label>' +
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
    '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close" onclick="submit_edit_student(' + data.student_id + ')">Đồng Ý</button>' +
    '</div></div></form></div></div>';
}

function student_del_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" href="#del-' + data.student_id + '" id="#del-' + data.student_id + '">Xóa</a>' +
    '<div id="del-' + data.student_id + '" class="modal"><div class="modal-content">' +
    '<h5>Cảnh Báo</h5><p>Xác nhận xóa tài khoản ' + data.username + '</p></div>' +
    '<form action="" method="POST" role="form" onsubmit="submit_del_student(this.id)" id="form-del-student-' + data.student_id + '">' +
    '<div class="modal-footer"><a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a>' +
    '<input type="hidden" value="' + data.student_id + '" name="student_id">' +
    '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button></div></form></div>';
}

function submit_add_student(data) {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=check_add_student";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_students').DataTable().ajax.reload();
            $('.modal').modal();
            $('select').select();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function submit_add_student_via_file() {
    $('#preload').removeClass('hidden');
    $('#error').text('');
    var file_data = $('#file_data').prop('files')[0];
    var class_id = $('#_student_add_class_id').val();
    var type = file_data.type;
    var size = file_data.size;
    var match = ["application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel"];
    if (type == match[0] || type == match[1]) {
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('class_id', class_id);
        $.ajax({
            url: 'index.php?action=check_add_student_via_file',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(result) {
                var json_data = $.parseJSON(result);
                show_status(json_data);
                $('#table_students').DataTable().ajax.reload();
                $('.modal').modal();
                $('select').select();
            }
        });
    } else {
        $('#error').text('Sai định dạng mẫu, yêu cầu file excel đuôi .xlsx theo mẫu. Nếu file lỗi vui lòng tải lại mẫu và điền lại.');
    }
    $('#preload').addClass('hidden');
}

function submit_del_student(data) {
    $('#preload').removeClass('hidden');
    data = $('#' + data).serializeArray();
    var url = "index.php?action=check_del_student";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_students').DataTable().ajax.reload();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function submit_edit_student(data) {
    $('#preload').removeClass('hidden');
    form = $('#form-edit-student-' + data);
    data = $('#form-edit-student-' + data).serializeArray();
    var url = "index.php?action=check_edit_student";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_students').DataTable().ajax.reload();
            form[0].reset();
            $('.modal').modal();
            $('select').select();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}