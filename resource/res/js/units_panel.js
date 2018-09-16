$(function() {
    get_list_units();
    $('#add_unit_form').on('submit', function() {
        submit_add_unit($('#add_unit_form').serializeArray());
        $('#add_unit_form')[0].reset();
        check_status('add', 0);
    });
    $('#select_all').on('change', function() {
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
            $('#select_action').removeClass('hidden');
        }else{
            $('.checkbox').each(function(){
                this.checked = false;
            });
            $('#select_action').addClass('hidden');
        }
    });
    $('table').on('click', 'a.modal-trigger', function(){
        $('select').select();
        select_status();
        var elem = document.querySelector(this.id);
        var instance = M.Modal.init(elem);
        var instance = M.Modal.getInstance(elem);
        instance.open();
    });
});

function check_box() {
    $('#select_action').removeClass('hidden');
    if($('.checkbox:checked').length == $('.checkbox').length){
        $('#select_all').prop('checked',true);
    }else{
        $('#select_all').prop('checked',false);
    }
    if($('.checkbox:checked').length == 0) {
        $('#select_action').addClass('hidden');
    }
}

function delete_check() {
    var _list_check = '';
    $('.checkbox:checked').each(function(){
        _list_check += this.value + ','
    });
    data = {
        list_check : _list_check
    }
    $('#preload').removeClass('hidden');
    var url = "index.php?action=delete_check_units";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#table_units').DataTable().destroy();
        get_list_units();
        $('#select_all').prop('checked',false);
        $('#select_action').addClass('hidden');
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
    
}

function get_list_units() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_units";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_units(json_data);
        $("form").on('submit', function(event) {
            event.preventDefault();
        });
        $('.modal').modal();
        $('select').select();
        select_status();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_list_units(data) {
    var list = $('#list_units');
    list.empty();
    $.each(data, function(key, value) {
        var tr = $('<tr question="fadeIn" id="unit-' + value.unit + '"></tr>');
        tr.append('<td><p><label><input type="checkbox" name="checkbox_students" class="checkbox" onchange="check_box();" value="' + value.unit + '" /><span></span></label></p></td>');
        tr.append('<td>' + value.unit + '</td>');
        tr.append('<td>' + value.detail + '</td>');
        tr.append('<td>' + value.time_to_do + '</td>');
        tr.append('<td>' + value.status_detail + '</td>');
        if(value.close_time == '' || value.close_time == '0000-00-00 00:00:00')
            value.close_time = 'Chưa Xác Định';
        tr.append('<td>' + value.close_time + '</td>');
        tr.append('<td>' + unit_edit_button(value) + '<br />' + unit_del_button(value) + '</td>');
        list.append(tr);
    });
    $('#table_units').DataTable(  {
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
        { "bSortable": false, "aTargets": [ 0, 5 ] }, //hide sort icon on header of column 0, 5
        ],
        'aaSorting': [[1, 'asc']] // start to sort data in second column
    }  );
    // $('select').select();
}

// function unit_insert_data(value) {
//     var list = $('#list_units');
//     var tr = $('<tr question="fadeIn" id="unit-' + value[0].unit + '"></tr>');
//     tr.append('<td>' + value[0].unit + '</td>');
//     tr.append('<td>' + value[0].detail + '</td>');
//     tr.append('<td>' + value[0].status_detail + '</td>');
//     tr.append('<td>' + value[0].close_time + '</td>');
//     tr.append('<td>' + unit_edit_button(value[0]) + '<br />' + unit_del_button(value[0]) + '</td>');
//     list.append(tr);
//     $("form").on('submit', function(event) {
//         event.preventDefault();
//     });
// }

function unit_edit_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="#edit-' + data.unit + '" id="#edit-' + data.unit + '">Sửa</a>' +
    '<div id="edit-' + data.unit + '" class="modal modal-edit">' +
    '<div class="row col l12">' +
    '<form action="" method="POST" role="form" id="form-edit-unit-' + data.unit + '">' +
    '<div class="modal-content"><h5>Sửa: ' + data.detail + '</h5>' +
    '<div class="modal-body">' +
    '<div class="input-field">' +
    '<input type="hidden" value="' + data.unit + '" name="unit">' +
    '<input type="text" value="' + data.detail + '" name="detail">' +
    '<label for="name" class="active">Tên Chương</label>' +
    '</div>' +
    '<div class="input-field">' +
    '<select name="status_id" onchange="check_status(' + data.unit + ',this.value)">' +
    '</select>' +
    '<label>Trạng Thái</label>' +
    '</div>' +
    '<div class="input-field hidden" id="close_time_' + data.unit + '">' +
    '<label for="close_time" class="active">Thời Gian Đóng</label>' +
    '<input id="close_time" type="datetime-local" name="close_time">' +
    '<span class="helptext">VD: 2018-11-16 15:25:33</span>' +
    '</div>' +
    '</div></div>' +
    '</div>' +
    '<div class="modal-footer">' +
    '<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trở Lại</a>' +
    '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close" onclick="submit_edit_unit(' + data.unit + ')">Đồng Ý</button>' +
    '</div>' +
    '</form></div>' +
    '</div>';
}

function unit_del_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" href="#del-' + data.unit + '" id="#del-' + data.unit + '">Xóa</a>' +
    '<div id="del-' + data.unit + '" class="modal"><div class="modal-content">' +
    '<h5>Cảnh Báo</h5><p>Xác nhận xóa ' + data.detail + '</p></div>' +
    '<form action="" method="POST" role="form" onsubmit="submit_del_unit(this.id)" id="form-del-unit-' + data.unit + '">' +
    '<div class="modal-footer"><a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a>' +
    '<input type="hidden" value="' + data.unit + '" name="unit">' +
    '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button></div></form></div>';
}

function check_status(id, value) {
    if (value == 3) {
        $('#close_time_' + id + '').removeClass('hidden');
    } else {
        $('#close_time_' + id + '').addClass('hidden');
    }
}

function submit_add_unit(data) {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=check_add_unit";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_units').DataTable().destroy();
            get_list_units();
            // unit_insert_data(json_data);
            // $('.modal').modal();
            // $('select').select();
            // select_status();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function submit_edit_unit(data) {
    $('#preload').removeClass('hidden');
    data = $('#form-edit-unit-' + data + '').serializeArray();
    var url = "index.php?action=check_edit_unit";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_units').DataTable().destroy();
            get_list_units();
            // $('#unit-' + json_data[0].unit + '').remove();
            // unit_insert_data(json_data);
            // $('.modal').modal();
            // $('select').select();
            // select_status();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function submit_del_unit(data) {
    $('#preload').removeClass('hidden');
    data = $('#' + data).serializeArray();
    var url = "index.php?action=check_del_unit";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            // $('#unit-' + json_data.unit).hide('400', function() {
            //     this.remove();
            // });
            $('#table_units').DataTable().destroy();
            get_list_units();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}