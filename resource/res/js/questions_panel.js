$(function() {
    get_list_questions();
    $('#add_question_form').on('submit', function() {
        submit_add_question($('#add_question_form').serializeArray());
        $('#add_question_form')[0].reset();
    });
});

function get_list_questions() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_questions";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_questions(json_data);
        select_unit();
        select_grade();
        $('.modal').modal();
        $('select').select();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_list_questions(data) {
    $('#preload').removeClass('hidden');
    var list = $('#list_questions');
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="fadeIn" id="question-' + data[i].ID + '"></tr>');
        tr.append('<td class="">' + data[i].ID + '</td>');
        tr.append('<td class="">' + data[i].question_detail + '</td>');
        tr.append('<td class="">' + data[i].grade_detail + '</td>');
        tr.append('<td class="">' + data[i].question_unit + '</td>');
        tr.append('<td class="">' + data[i].answer_a + '</td>');
        tr.append('<td class="">' + data[i].answer_b + '</td>');
        tr.append('<td class="">' + data[i].answer_c + '</td>');
        tr.append('<td class="">' + data[i].answer_d + '</td>');
        tr.append('<td class="">' + data[i].correct_answer + '</td>');
        tr.append('<td class="">' + question_edit_button(data[i]) + '<br />' + question_del_button(data[i]) + '</td>');
        list.append(tr);
    }
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function question_edit_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="#edit-' + data.ID + '">Sửa</a>' +
        '<div id="edit-' + data.ID + '" class="modal modal-edit">' +
        '<div class="row col l12">' +
        '<form action="" method="POST" role="form" id="form-edit-question-' + data.ID + '">' +
        '<div class="modal-content"><h5>Sửa: ' + data.question_detail + '</h5>' +
        '<div class="modal-body">' +
        '<div class="col l12 s12" style="padding-top: 20px">' +
        '<div class="input-field">' +
        '<input type="hidden" id="ID" name="ID" value="' + data.ID + '">' +
        '<textarea id="question_detail" name="question_detail" class="materialize-textarea" required>' + data.question_detail + '</textarea>' +
        '<label for="question_detail" class="active">Câu Hỏi</label>' +
        '</div>' +
        '</div>' +
        '<div class="row col l12">' +
        '<div class="col l6 s12">' +
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
        '</div>' +
        '<div class="col l6 s12">' +
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
        '<select name="unit" id="unit">' +
        '</select>' +
        '<label>Chương</label>' +
        '</div>' +
        '</div>' +
        '</div></div></div>' +
        '<div class="row col l12 s12 modal-footer">' +
        '<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trở Lại</a>' +
        '<button type="submit" class="waves-effect waves-green btn-flat" onclick="submit_edit_question(' + data.ID + ')">Đồng Ý</button>' +
        '</div></form></div></div>';
}

function question_del_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" href="#del-' + data.ID + '">Xóa</a>' +
        '<div id="del-' + data.ID + '" class="modal"><div class="modal-content">' +
        '<h5>Cảnh Báo</h5><p>Xác nhận xóa ' + data.question_detail + '</p></div>' +
        '<form action="" method="POST" role="form" onsubmit="submit_del_question(this.id)" id="form-del-question-' + data.ID + '">' +
        '<div class="modal-footer"><a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a>' +
        '<input type="hidden" value="' + data.ID + '" name="ID">' +
        '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button></div></form></div>';
}

function submit_add_question(data) {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=check_add_question";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            question_insert_data(json_data);
            select_unit();
            select_grade();
            $('.modal').modal();
            $('select').select();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function submit_del_question(data) {
    $('#preload').removeClass('hidden');
    data = $('#' + data).serializeArray();
    var url = "index.php?action=check_del_question";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#question-' + json_data.ID).hide('400', function() {
                this.remove();
            });
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
            $('#question-' + json_data.ID).remove();
            question_insert_data(json_data);
            form[0].reset();
            select_unit();
            select_grade();
            $('.modal').modal();
            $('select').select();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function question_insert_data(data) {
    var list = $('#list_questions');
    var tr = $('<tr question="fadeIn" id="question-' + data.ID + '"></tr>');
    tr.append('<td question="">' + data.ID + '</td>');
    tr.append('<td question="">' + data.question_detail + '</td>');
    tr.append('<td question="">' + data.grade_detail + '</td>');
    tr.append('<td question="">' + data.question_unit + '</td>');
    tr.append('<td question="">' + data.answer_a + '</td>');
    tr.append('<td question="">' + data.answer_b + '</td>');
    tr.append('<td question="">' + data.answer_c + '</td>');
    tr.append('<td question="">' + data.answer_d + '</td>');
    tr.append('<td question="">' + data.correct_answer + '</td>');
    tr.append('<td question="">' + question_edit_button(data) + '<br />' + question_del_button(data) + '</td>');
    list.append(tr);
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}