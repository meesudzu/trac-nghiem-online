$(function() {
    get_list_questions();
    $('select').select();
    $('#select_all').on('change', function() {
        if (this.checked) {
            $('.checkbox').each(function() {
                this.checked = true;
            });
            $('#select_action').removeClass('hidden');
        } else {
            $('.checkbox').each(function() {
                this.checked = false;
            });
            $('#select_action').addClass('hidden');
        }
    });
    $('table').on('click', 'a.modal-trigger', function() {
        var elem = document.querySelector(this.id);
        var instance = M.Modal.init(elem);
        var instance = M.Modal.getInstance(elem);
        instance.open();
    });
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
});

function check_box() {
    $('#select_action').removeClass('hidden');
    if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('#select_all').prop('checked', true);
    } else {
        $('#select_all').prop('checked', false);
    }
    if ($('.checkbox:checked').length == 0) {
        $('#select_action').addClass('hidden');
    }
}

function delete_check() {
    var _list_check = '';
    $('.checkbox:checked').each(function() {
        _list_check += this.value + ','
    });
    data = {
        list_check: _list_check
    }
    $('#preload').removeClass('hidden');
    var url = "index.php?action=delete_check_questions";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#table_students').DataTable().ajax.reload();
        $('#select_all').prop('checked', false);
        $('#select_action').addClass('hidden');
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);

}

function get_list_questions() {
    $('#table_questions').DataTable( {
        "sPaginationType" : "full_numbers",
        "processing": true,
        "serverSide": true,
        "ajax": {
            url :"index.php?action=list_questions",
            type: "post",
            error: function(res){
                console.log("Error");
            }
        },
        "columns": [
        {
            "data": "question_id",
            "title": '<p><label><input type="checkbox" id="select_all" /><span></span></label></p>'
        },
        {
            "data": "question_id",
            "title": "ID"
        },
        {
            "data": "question_content",
            "title": "Câu Hỏi"
        },
        {
            "data": "question_id",
            "title": "Thông Tin"
        },
        {
            "data": "answer_a",
            "title": "A"
        },
        {
            "data": "answer_b",
            "title": "B"
        },
        {
            "data": "answer_c",
            "title": "C"
        },
        {
            "data": "answer_d",
            "title": "D"
        },
        {
            "data": "correct_answer",
            "title": "Đúng"
        },
        {
            "data": "question_id",
            "title": '<i class="material-icons">settings</i>'
        }
        ],
        "columnDefs":[
        {
            "targets":0,
            "render": function(data) 
            {
                return '<p><label><input type="checkbox" name="checkbox_students" class="checkbox" onchange="check_box();" value="' + data + '" /><span></span></label></p>'
            }
        },
        {
            "targets":3,
            "render": function(data, type, meta) 
            {
                return 'Môn ' + meta.subject_detail + ', Chương ' + meta.unit + ', ' + meta.level_detail + ', ' + meta.grade_detail + '';
            }
        },
        {
            "targets":9,
            "render": function(data, type, meta) 
            {
                var button = question_edit_button(meta) + '<br />' + question_del_button(meta);
                $("form").on('submit', function(event) {
                    event.preventDefault();
                });
                return button;
            }
        },
        {
            "bSortable": false,
            "aTargets": [0, 9]
        },
        ],
        'aaSorting': [
        [1, 'asc']
        ],
        "language": {
            "lengthMenu": "Hiển thị _MENU_",
            "zeroRecords": "Không tìm thấy",
            "info": "Hiển thị trang _PAGE_/_PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "emptyTable": "Không có dữ liệu",
            "infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
            "sSearch": "Tìm kiếm",
            "processing": "Đang tải!",
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Sau",
                "previous": "Trước"
            },
        },
        "drawCallback": function(settings) {
            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
        }
    } );
    $('.modal').modal();
    $('select').select();
    $('body').attr('style', 'overflow: auto;');
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function question_edit_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="sua-cau-hoi-' + data.question_id + '"">Sửa</a>';
}

function question_del_button(data) {
    return btn = '<a class="waves-effect waves-light btn modal-trigger" href="#del-' + data.question_id + '" id="#del-' + data.question_id + '">Xóa</a>' +
    '<div id="del-' + data.question_id + '" class="modal"><div class="modal-content">' +
    '<h5>Cảnh Báo</h5><p>Xác nhận xóa ' + data.question_content + '</p></div>' +
    '<form action="" method="POST" role="form" onsubmit="submit_del_question(this.id)" id="form-del-question-' + data.question_id + '">' +
    '<div class="modal-footer"><a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a>' +
    '<input type="hidden" value="' + data.question_id + '" name="question_id">' +
    '<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button></div></form></div>';
}

function submit_del_question(data) {
    $('#preload').removeClass('hidden');
    data = $('#' + data).serializeArray();
    var url = "index.php?action=check_del_question";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_students').DataTable().ajax.reload();
        }
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}
