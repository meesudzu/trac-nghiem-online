$(function() {
    get_teacher_notifications();
    get_student_notifications();
    select_teacher();
    select_class();
    $('#send_notification').on('submit', function() {
        send_notification();
        $('#send_notification')[0].reset();
    });
});

function get_teacher_notifications() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_teacher_notifications";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_teacher_notifications(json_data);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_teacher_notifications(data) {
    var list = $('#teacher_content');
    list.empty();
    for (var i = 0; i < data.length; i++) {
        var message = $('<div class="fadeIn message" id="teacher-notifications-' + data[i].notification_id + '"></div>');
        message.append('<span class="notification_id">#' + data[i].notification_id + '</span> - ');
        message.append('<span class="name">' + data[i].name + '</span>');
        message.append('<span class="username"> ( ' + data[i].username + ' )</span>');
        message.append('<span class="notification_title">' + data[i].notification_title + '</span>');
        message.append('<span class="notification_content">' + data[i].notification_content + '</span>');
        message.append('<span class="receive_name">Nhận: ' + data[i].receive_name + '<span class="receive_username"> ( ' + data[i].receive_username + ' )</span></span>');
        message.append('<span class="time_sent">[ ' + data[i].time_sent + ' ]</span>');
        list.append(message);
    }
}


function get_student_notifications() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_student_notifications";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_student_notifications(json_data);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_student_notifications(data) {
    var list = $('#student_content');
    list.empty();
    for (var i = 0; i < data.length; i++) {
        var message = $('<div class="fadeIn message" id="student-notifications-' + data[i].notification_id + '"></div>');
        message.append('<span class="notification_id">#' + data[i].notification_id + '</span> - ');
        message.append('<span class="name">' + data[i].name + '</span>');
        message.append('<span class="username"> ( ' + data[i].username + ' )</span>');
        message.append('<span class="notification_title">' + data[i].notification_title + '</span>');
        message.append('<span class="notification_content">' + data[i].notification_content + '</span>');
        message.append('<span class="time_sent">[ ' + data[i].time_sent + ' ]</span>');
        message.append('<span class="receive_name">Nhận: ' + data[i].class_name + '</span>');
        list.append(message);
    }
}

function send_notification() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=send_notification";
    var teacher_id_value = M.Select.getInstance($('#teacher_id')).getSelectedValues();
    var class_id_value = M.Select.getInstance($('#class_id')).getSelectedValues();
    teacher_id = JSON.stringify(teacher_id_value);
    class_id = JSON.stringify(class_id_value);
    var notification_title = $('#notification_title').val();
    var notification_content = $('#notification_content').val();
    var data = {
        teacher_id: teacher_id,
        class_id: class_id,
        notification_title: notification_title,
        notification_content: notification_content
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        get_student_notifications();
        get_teacher_notifications();
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}