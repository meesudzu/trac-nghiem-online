$(function () {
    get_chat_all();
})
function get_chat_all(ID) {
    var url = "index.php?action=get_chat_all";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        insert_chats(json_data);
    };
    $.get(url, success);
}

function insert_chats(data) {
    var list = $('#student_chats');
    list.empty();
    for (var i = 0; i < data.length; i++) {
        var message = $('<div class="fadeIn message" id="teacher-notifications-' + data[i].ID + '"></div>');
        message.append('<span class="notification_id">#' + data[i].ID + '</span> - ');
        message.append('<span class="name">' + data[i].name + '</span>');
        message.append('<span class="username">( ' + data[i].username + ' )</span>');
        message.append('<span class="notification_content">' + data[i].chat_content + '</span>');
        message.append('<span class="time_sent">[ ' + data[i].time_sent + ' ]</span>');
        list.append(message);
    }
}