$(function() {
    $('#table_questions').DataTable().destroy();
    get_list_questions();
    $('.tabs').tabs();
    $('#add_question_form').on('submit', function() {
        submit_add_question($('#add_question_form').serializeArray());
        $('#add_question_form')[0].reset();
    });
    $('#add_via_file').on('submit', function() {
        $('#preload').removeClass('hidden');
        submit_add_question_via_file();
        $('#add_via_file')[0].reset();
        $('#preload').removeClass('hidden');
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
        select_grade();
        select_subject();
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
    var url = "index.php?action=delete_check_questions";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#table_questions').DataTable().destroy();
        get_list_questions();
        $('#select_all').prop('checked',false);
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
        select_grade();
        select_subject();
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
        tr.append('<td class="">Môn ' + data[i].subject_detail + '<br />Chương ' + data[i].unit + ' ' + data[i].grade_detail + '</td>');
        tr.append('<td class="">' + data[i].answer_a + '</td>');
        tr.append('<td class="">' + data[i].answer_b + '</td>');
        tr.append('<td class="">' + data[i].answer_c + '</td>');
        tr.append('<td class="">' + data[i].answer_d + '</td>');
        tr.append('<td class="">' + data[i].correct_answer + '</td>');
        tr.append('<td class="">' + question_edit_button(data[i]) + '<br />' + question_del_button(data[i]) + '</td>');
        list.append(tr);
    }
    $('#table_questions').DataTable(  {
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
        { "bSortable": false, "aTargets": [ 0, 9 ] }, //hide sort icon on header of column 0, 10
        ],
        'aaSorting': [[1, 'asc']] // start to sort data in second column
    }  );
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function question_edit_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="#edit-' + data.question_id + '" id="#edit-' + data.question_id + '">Sửa</a>' +
    '<div id="edit-' + data.question_id + '" class="modal modal-edit">' +
    '<div class="row col l12">' +
    '<form action="" method="POST" role="form" id="form-edit-question-' + data.question_id + '">' +
    '<div class="modal-content"><h5>Sửa: ' + data.question_content + '</h5>' +
    '<div class="modal-body">' +
    '<div class="col l12 s12" style="padding-top: 20px">' +
    '<div class="input-field">' +
    '<input type="hidden" id="question_id" name="question_id" value="' + data.question_id + '">' +
    '<textarea id="question_content" name="question_content" class="materialize-textarea" required>' + data.question_content + '</textarea>' +
    '<label for="question_content" class="active">Câu Hỏi</label>' +
    '</div>' +
    '<div class="input-field">' +
    '<label for="answer_a" class="active">A</label>' +
    '<input type="text" id="answer_a" name="answer_a" value="' + data.answer_a + '" required>' +
    '</div>' +
    '<div class="input-field">' +
    '<label for="answer_b" class="active">B</label>' +
    '<input type="text" id="answer_b" name="answer_b" value="' + data.answer_b + '" required>' +
    '</div>' +
    '<div class="input-field">' +
    '<label for="answer_c" class="active">C</label>' +
    '<input type="text" id="answer_c" name="answer_c" value="' + data.answer_c + '" required>' +
    '</div>' +
    '<div class="input-field">' +
    '<label for="answer_d" class="active">D</label>' +
    '<input type="text" id="answer_d" name="answer_d" value="' + data.answer_d + '" required>' +
    '</div>' +
    '<div class="input-field">' +
    '<label for="correct_answer" class="active">Đúng</label>' +
    '<input type="text" id="correct_answer" name="correct_answer" value="' + data.correct_answer + '" required>' +
    '</div>' +
    '<div class="input-field">' +
    '<select name="grade_id" id="grade_id">' +
    '</select>' +
    '<label>Khối</label>' +
    '</div>' +
    '<div class="input-field">' +
    '<select name="subject_id" id="subject_id">' +
    '</select>' +
    '<label>Môn</label>' +
    '</div>' +
    '<div class="input-field">' +
    '<input name="unit" type="number" required value="' + data.unit + '">' +
    '<label class="active">Chương</label>' +
    '</div>' +
    '</div>' +
    '</div>' +
    '</div></div>' +
    '<div class="row col l12 s12 modal-footer">' +
    '<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trở Lại</a>' +
    '<button type="submit" class="waves-effect waves-green btn-flat" onclick="submit_edit_question(' + data.question_id + ')">Đồng Ý</button>' +
    '</div></form></div></div>';
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

function submit_add_question(data) {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=check_add_question";
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

function submit_add_question_via_file() {
    $('#preload').removeClass('hidden');
    $('#error').text('');
    var file_data = $('#file_data').prop('files')[0];
    var subject = $('#_subject').val();
    var type = file_data.type;
    var size = file_data.size;
    var match = ["application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel"];
    if (type == match[0] || type == match[1]) {
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('subject_id', subject);
        $.ajax({
            url: 'index.php?action=check_add_question_via_file',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(result) {
                var json_data = $.parseJSON(result);
                show_status(json_data);
                $('#table_questions').DataTable().destroy();
                get_list_questions();
                $('.modal').modal();
                $('select').select();
            }
        });
    } else {
        $('#error').text('Sai định dạng mẫu, yêu cầu file excel đuôi .xlsx theo mẫu. Nếu file lỗi vui lòng tải lại mẫu và điền lại.');
    }
    $('#preload').addClass('hidden');
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

function submit_edit_question(data) {
    $('#preload').removeClass('hidden');
    form = $('#form-edit-question-' + data);
    data = $('#form-edit-question-' + data).serializeArray();
    var url = "index.php?action=check_edit_question";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_questions').DataTable().destroy();
            get_list_questions();
            form[0].reset();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}
