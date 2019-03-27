$(function() {
    $('.tabs').tabs();
    $('select').select();
    select_grade();
    select_subject();
    $('#add_question_form').on('submit', function() {
        submit_add_question($('#add_question_form').serializeArray());
        $('#add_question_form')[0].reset();
        CKEDITOR.instances.question_detail.setData('', function() {
            this.updateElement();
        })
        CKEDITOR.instances.answer_a.setData('', function() {
            this.updateElement();
        })
        CKEDITOR.instances.answer_b.setData('', function() {
            this.updateElement();
        })
        CKEDITOR.instances.answer_c.setData('', function() {
            this.updateElement();
        })
        CKEDITOR.instances.answer_d.setData('', function() {
            this.updateElement();
        })
    });
    $('#add_via_file').on('submit', function() {
        $('#preload').removeClass('hidden');
        submit_add_question_via_file();
        $('#add_via_file')[0].reset();
        $('#preload').removeClass('hidden');
    });
});

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

function submit_add_question(data) {
    data[0]['value'] = CKEDITOR.instances.question_detail.getData();
    data[1]['value'] = CKEDITOR.instances.answer_a.getData();
    data[2]['value'] = CKEDITOR.instances.answer_b.getData();
    data[3]['value'] = CKEDITOR.instances.answer_c.getData();
    data[4]['value'] = CKEDITOR.instances.answer_d.getData();
    $('#preload').removeClass('hidden');
    var url = "index.php?action=check_add_question";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        select_grade();
        select_subject();
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
    var match = ["application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel", "application/wps-office.xlsx"];
    if (type == match[0] || type == match[1] || type == match[2]) {
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
                select_grade();
                select_subject();
            }
        });
    } else {
        $('#error').text('Sai định dạng mẫu, yêu cầu file excel đuôi .xlsx theo mẫu. Nếu file lỗi vui lòng tải lại mẫu và điền lại.');
    }
    $('#preload').addClass('hidden');
}