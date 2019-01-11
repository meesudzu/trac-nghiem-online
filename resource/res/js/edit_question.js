$(function() {
    $('select').select();
    $('#edit_question_form').on('submit', function() {
        submit_edit_question($('#edit_question_form').serializeArray());
    });
});

function submit_edit_question(data) {
    data[0]['value'] = CKEDITOR.instances.question_detail.getData();
    data[1]['value'] = CKEDITOR.instances.answer_a.getData();
    data[2]['value'] = CKEDITOR.instances.answer_b.getData();
    data[3]['value'] = CKEDITOR.instances.answer_c.getData();
    data[4]['value'] = CKEDITOR.instances.answer_d.getData();
    console.log(data)
    $('#preload').removeClass('hidden');
    var url = "index.php?action=check_edit_question";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            window.setTimeout(function() {
                window.location.href = "/index.php?action=show_questions_panel";
            }, 2000);
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}