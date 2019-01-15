$(function() {
    $('#table_questions').DataTable().destroy();
    get_list_questions();
    $('select').select();
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
        var elem = document.querySelector(this.id);
        var instance = M.Modal.init(elem);
        var instance = M.Modal.getInstance(elem);
        instance.open();
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
    var url = "index.php?action=delete_check_questions";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#table_questions').DataTable().destroy();
        get_list_questions();
        $('#select_all').prop('checked', false);
        $('#select_action').addClass('hidden');
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);

}

function get_list_questions() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_questions";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_questions(json_data);
        $('.modal').modal();
        $('select').select();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_list_questions(data) {
    var list = $('#list_questions');
    list.empty();
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="fadeIn" id="question-' + data[i].question_id + '"></tr>');
        tr.append('<td class=""><p><label><input type="checkbox" name="checkbox_students" class="checkbox" onchange="check_box();" value="' + data[i].question_id + '" /><span></span></label></p></td>');
        tr.append('<td class="">' + data[i].question_id + '</td>');
        tr.append('<td class="">' + data[i].question_content + '</td>');
        tr.append('<td class="">Môn ' + data[i].subject_detail + ', Chương ' + data[i].unit + ', ' + data[i].level_detail + ', ' + data[i].grade_detail + '</td>');
        tr.append('<td class="">' + data[i].answer_a + '</td>');
        tr.append('<td class="">' + data[i].answer_b + '</td>');
        tr.append('<td class="">' + data[i].answer_c + '</td>');
        tr.append('<td class="">' + data[i].answer_d + '</td>');
        tr.append('<td class="">' + data[i].correct_answer + '</td>');
        tr.append('<td class="">' + question_edit_button(data[i]) + '<br />' + question_del_button(data[i]) + '</td>');
        list.append(tr);
    }
    $('#table_questions').DataTable({
        "language": {
            "lengthMenu": "Hiển thị _MENU_",
            "zeroRecords": "Không tìm thấy",
            "info": "Hiển thị trang _PAGE_/_PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "emptyTable": "Không có dữ liệu",
            "infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
            "sSearch": "Tìm kiếm",
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Sau",
                "previous": "Trước"
            },
        },
        "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0, 9]
            }, //hide sort icon on header of column 0, 10
        ],
        'aaSorting': [
            [1, 'asc']
        ], // start to sort data in second column
        "drawCallback": function(settings) {
            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
        }
    });
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function question_edit_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="index.php?action=show_edit_question&id=' + data.question_id + '"">Sửa</a>';
}

function question_del_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" href="#del-' + data.question_id + '" id="#del-' + data.question_id + '">Xóa</a>' +
        '<div id="del-' + data.question_id + '" class="modal"><div class="modal-content">' +
        '<h5>Cảnh Báo</h5><p>Xác nhận xóa ' + data.question_content + '</p></div>' +
        '<form action="" method="POST" role="form" onsubmit="submit_del_question(this.id)" id="form-del-question-' + data.question_id + '">' +
        '<div class="modal-footer"><a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a>' +
        '<input type="hidden" value="' + data.question_id + '" name="question_id">' +
        '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button></div></form></div>';
}

function submit_del_question(data) {
    $('#preload').removeClass('hidden');
    data = $('#' + data).serializeArray();
    var url = "index.php?action=check_del_question";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_questions').DataTable().destroy();
            get_list_questions();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}