$(function() {
    $('select').select();
    $('.modal').modal();
    $('#upload_profiles').on('submit', function() {
        submit_update_profiles($('#upload_profiles').serializeArray());
        $('#profiles-password').val('');
    });
});

function get_profiles() {
    var url = "index.php?action=get_profiles";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        update_profiles(json_data);
        set_profiles_sidebar(json_data);
    };
    $.get(url, success);
}

function set_profiles_sidebar(data) {
    $('#user-avatar').attr('src', 'upload/avatar/' + data.avatar + '');
    $('#user-name').text(data.name);
}

function update_profiles(data) {
    $('#profiles-avatar').attr('src', 'upload/avatar/' + data.avatar + '');
    $('#profiles-name').val(data.name);
    $('#profiles-username').val(data.username);
    $('#profiles-new-email').val(data.email);
    $('#profiles-current-email').val(data.email);
    $('#profiles-birthday').val(data.birthday);
    $('#gender').val(data.gender_id);
    $('#profiles-last-login').text(data.last_login);
    M.updateTextFields();
}

function submit_update_profiles(data) {
    var url = "index.php?action=submit_update_profiles";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            get_profiles();
            $('select').select();
        }
    };
    $.post(url, data, success);
}

function update_avatar() {
    $('#avatar_uploading').removeClass('hidden');
    var file_data = $('#file').prop('files')[0];
    var type = file_data.type;
    var size = file_data.size;
    var match = ["image/png", "image/jpg", "image/jpeg"];
    if ((type == match[0] && size < 2048000) || (type == match[1] && size < 2048000) || (type == match[2] && size < 2048000)) {
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: 'index.php?action=submit_update_avatar',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(result) {
                $('.help').css('color', 'green').text("Thành công");
                $('#file').val('');
                get_profiles();
                $('#avatar_uploading').addClass('hidden');
            }
        });
    } else {
        $('.help').css('color', 'red').text('Chỉ được upload file JPG, PNG nhỏ hơn 2mb');
        $('#file').val('');
        $('#avatar_uploading').addClass('hidden');
    }
}