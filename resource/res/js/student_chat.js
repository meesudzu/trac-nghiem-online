$(function () {
    get_chats();
    $("form").on('submit', function(event) {
        event.preventDefault();
        send_chat();
        $("form")[0].reset();
        $('#label-chat').addClass('active');
    });
})

function get_chats() {
    var url = "index.php?action=get_chats";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        insert_chats(json_data);
    };
    $.get(url, success);
}

function insert_chats(data) {
    var list = $('#student_chats');
    list.empty();
    for (var i = data.length-1; i >= 0; i--) {
        var message = $('<div class="fadeIn message" id="teacher-notifications-' + data[i].ID + '"></div>');
        message.append('<span class="notification_id">#' + data[i].ID + '</span> - ');
        message.append('<span class="name">' + data[i].name + '</span>');
        message.append('<span class="username">( ' + data[i].username + ' )</span>');
        message.append('<span class="notification_content">' + data[i].chat_content + '</span>');
        message.append('<span class="time_sent">[ ' + data[i].time_sent + ' ]</span>');
        list.append(message);
    }
}

function send_chat () {
    var content = $('#content').val();
    var url = "index.php?action=send_chat";
    var data = {
        content : content
    }
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        get_chats();
    };
    $.post(url, data, success);
}
