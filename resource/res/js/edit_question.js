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
    $('#preload').removeClass('hidden');
    var url = "index.php?action=check_edit_question";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            window.setTimeout(function() {
                window.location.href = "quan-ly-ngan-hang-cau-hoi";
            }, 2000);
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function upload_image() {
    $('#uploading').removeClass('hidden');
    var file_data = $('#file').prop('files')[0];
    var type = file_data.type;
    var size = file_data.size;
    var match = ["image/png", "image/jpg", "image/jpeg"];
    if ((type == match[0] && size < 2048000) || (type == match[1] && size < 2048000) || (type == match[2] && size < 2048000)) {
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: 'index.php?action=uploadImage',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(result) {
                var json_data = jQuery.parseJSON(result);
                if(json_data.stt) {
                    $('#div-url').removeClass('hidden');
                    $('.help').css('color', 'green').text("Thành công");
                    $('#file').val('');
                    $('#url').val(json_data.url);
                    $('#uploading').addClass('hidden');
                } else {
                    $('#div-url').addClass('hidden');
                    $('.help').css('color', 'red').text("Thất bại");
                    $('#file').val('');
                    $('#url').val('');
                    $('#uploading').addClass('hidden');
                }
            }
        });
    } else {
        $('.help').css('color', 'red').text('Chỉ được upload file JPG, PNG nhỏ hơn 2mb');
        $('#file').val('');
        $('#uploading').addClass('hidden');
    }
}