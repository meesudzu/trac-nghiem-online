$(function() {
    get_notifications_to_student();
    get_notifications_by_admin();
    $('select').select();
    select_class();
});

function get_notifications_to_student() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_notifications_to_student";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        insert_student_notification(json_data);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function insert_student_notification(data) {
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
        list.append(message);
    }
}

function get_notifications_by_admin() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_notifications_by_admin";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        insert_admin_notification(json_data);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function insert_admin_notification(data) {
    var list = $('#admin_content');
    list.empty();
    for (var i = 0; i < data.length; i++) {
        var message = $('<div class="fadeIn message" id="teacher-notifications-' + data[i].notification_id + '"></div>');
        message.append('<span class="notification_id">#' + data[i].notification_id + '</span> - ');
        message.append('<span class="name">' + data[i].name + '</span>');
        message.append('<span class="username"> ( ' + data[i].username + ' )</span>');
        message.append('<span class="notification_title">' + data[i].notification_title + '</span>');
        message.append('<span class="notification_content">' + data[i].notification_content + '</span>');
        message.append('<span class="time_sent">[ ' + data[i].time_sent + ' ]</span>');
        list.append(message);
    }
}

function send_notification() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=send_notification";
    var class_id_value = M.Select.getInstance($('#class_id')).getSelectedValues();
    class_id = JSON.stringify(class_id_value);
    var notification_title = $('#notification_title').val();
    var notification_content = $('#notification_content').val();
    var data = {
        class_id: class_id,
        notification_title: notification_title,
        notification_content: notification_content
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        get_notifications_to_student();
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}

function select_class(data) {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_classes_by_teacher";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=class_id]');
        sl.empty();
        $.each(json_data, function(key, value) {
            sl.append('<option value="' + value.class_id + '">' + value.class_name + '</option>');
        });
        $('select').select();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}