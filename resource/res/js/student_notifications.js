$(function () {
    get_notifications();
})
function get_notifications(ID) {
    var url = "index.php?action=get_notifications";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        insert_notifications(json_data);
    };
    $.get(url, success);
}

function insert_notifications(data) {
    var list = $('#student_notifications');
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
