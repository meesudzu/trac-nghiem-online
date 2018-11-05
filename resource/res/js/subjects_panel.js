$(function() {
    get_list_subjects();
    $('#add_subject_form').on('submit', function() {
        submit_add_subject($('#add_subject_form').serializeArray());
        $('#add_subject_form')[0].reset();
    });
    $('table').on('click', 'a.modal-trigger', function(){
        $('select').select();
        select_teacher();
        select_grade();
        var elem = document.querySelector(this.id);
        var instance = M.Modal.init(elem);
        var instance = M.Modal.getInstance(elem);
        instance.open();
    });
});

function get_list_subjects() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_subjects";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_subjects(json_data);
        $('.modal').modal();
        $('select').select();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_list_subjects(data) {
    var list = $('#list_subjects');
    list.empty();
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="" id="subject-' + data[i].subject_id + '"></tr>');
        tr.append('<td class="">' + data[i].subject_id + '</td>');
        tr.append('<td class="">' + data[i].subject_detail + '</td>');
        tr.append('<td class="">' + subject_edit_button(data[i]) + '<br />' + subject_del_button(data[i]) + '</td>');
        list.append(tr);
    }
    $('#table_subjects').DataTable( {
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
        { "bSortable": false, "aTargets": [ 2 ] }, //hide sort icon on header of column 0, 5
        ]
    } );
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function subject_edit_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="#edit-' + data.subject_id + '" id="#edit-' + data.subject_id + '">Sửa</a>' +
    '<div id="edit-' + data.subject_id + '" class="modal modal-edit">' +
    '<div class="row col l12">' +
    '<form action="" method="POST" role="form" id="form-edit-subject-' + data.subject_id + '">' +
    '<div class="modal-content"><h5>Sửa: ' + data.subject_detail + '</h5>' +
    '<div class="modal-body">' +
    '<div class="col l12 s12">' +
    '<div class="input-field">' +
    '<input type="hidden" value="' + data.subject_id + '" name="subject_id">' +
    '<input type="text" value="' + data.subject_detail + '" name="subject_detail">' +
    '<label for="name" class="active">Tên Lớp</label>' +
    '</div>' +
    '</div>' +
    '</div></div>' +
    '<div class="row col l12 s12 modal-footer">' +
    '<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trở Lại</a>' +
    '<button type="submit" class="waves-effect waves-green btn-flat" onclick="submit_edit_subject(' + data.subject_id + ')">Đồng Ý</button>' +
    '</div></form></div></div>';
}

function subject_del_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" href="#del-' + data.subject_id + '" id="#del-' + data.subject_id + '">Xóa</a>' +
    '<div id="del-' + data.subject_id + '" class="modal"><div class="modal-content">' +
    '<h5>Cảnh Báo</h5><p>Xác nhận xóa ' + data.subject_detail + '</p></div>' +
    '<form action="" method="POST" role="form" onsubmit="submit_del_subject(this.id)" id="form-del-class-' + data.subject_id + '">' +
    '<div class="modal-footer"><a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a>' +
    '<input type="hidden" value="' + data.subject_id + '" name="subject_id">' +
    '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button></div></form></div>';
}

function submit_add_subject(data) {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=check_add_subject";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_subjects').DataTable().destroy();
            get_list_subjects();
            $('.modal').modal();
            $('select').select();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function submit_del_subject(data) {
    $('#preload').removeClass('hidden');
    data = $('#' + data).serializeArray();
    var url = "index.php?action=check_del_subject";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_subjects').DataTable().destroy();
            get_list_subjects();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function submit_edit_subject(data) {
    $('#preload').removeClass('hidden');
    form = $('#form-edit-subject-' + data);
    data = $('#form-edit-subject-' + data).serializeArray();
    var url = "index.php?action=check_edit_subject";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_subjects').DataTable().destroy();
            get_list_subjects();
            form[0].reset();
            $('.modal').modal();
            $('select').select();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}