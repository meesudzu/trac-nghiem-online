$(document).ready(function() {
    insert_dashboard_info();
});

function insert_dashboard_info() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_dashboard_info";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var dashboard = $('#dashboard');
        $.each(json_data, function(key, info) {
             var detail = '<div class="dashboard-inner-item">'+
             '<div class="left-item">'+
                    '<i class="fa '+ info.icon +' fa-2x"></i>'+
                '</div>'+
                '<div class="right-item">'+
                    '<div class="right-item-top">'+
                        info.count +
                    '</div>'+
                    '<div class="right-item-bottom">'+
                        info.name +
                    '</div>'+
                '</div>'+
                '<div class="clear"></div>'+
            '</div>';
            dashboard.append(detail);
        });

        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}