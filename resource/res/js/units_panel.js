$(function() {
	get_list_units();
	$('#add_unit_form').on('submit', function() {
		submit_add_unit($('#add_unit_form').serializeArray());
		$('#add_unit_form')[0].reset();
		check_status ('add',0);
	});
});

function get_list_units () {
	var url = "index.php?action=get_list_units";
	var success = function(result) {
		var json_data = $.parseJSON(result);
		show_list_units(json_data);
	};
	$.get(url, success);
}

function show_list_units (data) {
	var list = $('#list_units');
	list.empty();
	$.each(data, function(key, value) {
		var tr = $('<tr question="fadeIn" id="unit-' + value.unit + '"></tr>');
		tr.append('<td>' +  value.unit + '</td>');
		tr.append('<td>' +  value.detail + '</td>');
		tr.append('<td>' +  value.status_detail + '</td>');
		tr.append('<td>' +  value.close_time + '</td>');
		tr.append('<td>' + unit_edit_button(value) + '<br />' + unit_del_button(value) + '</td>');
		list.append(tr);
	});
	select_status();
	$('select').select();
}

function unit_insert_data (value) {
	var list = $('#list_units');
	var tr = $('<tr question="fadeIn" id="unit-' + value[0].unit + '"></tr>');
	tr.append('<td>' +  value[0].unit + '</td>');
	tr.append('<td>' +  value[0].detail + '</td>');
	tr.append('<td>' +  value[0].status_detail + '</td>');
	tr.append('<td>' +  value[0].close_time + '</td>');
	tr.append('<td>' + unit_edit_button(value[0]) + '<br />' + unit_del_button(value[0]) + '</td>');
	list.append(tr);
	select_status();
	$('select').select();
	$("form").on('submit', function(event) {
		event.preventDefault();
	});
}

function unit_edit_button(data) {
	return btn = '<a class="waves-effect waves-light btn modal-trigger" style="margin-bottom: 7px;" href="#edit-' + data.unit + '">Sửa</a>' +
	'<div id="edit-' + data.unit + '" class="modal modal-edit">' +
	'<div class="row col l12">' +
	'<form action="" method="POST" role="form" id="form-edit-unit-'+data.unit+'">' +
	'<div class="modal-content"><h5>Sửa: ' + data.detail + '</h5>' +
	'<div class="modal-body">' +
	'<div class="input-field">' +
	'<input type="hidden" value="' + data.unit + '" name="unit">' +
	'<input type="text" value="' + data.detail + '" name="detail">' +
	'<label for="name" class="active">Tên Chương</label>' +
	'</div>' +
	'<div class="input-field">' +
	'<select name="status_id" onchange="check_status('+data.unit+',this.value)">' +
	'</select>' +
	'<label>Trạng Thái</label>' +
	'</div>' +
	'<div class="input-field hidden" id="close_time_'+data.unit+'">' +
	'<label for="close_time" class="active">Thời Gian Đóng</label>' +
	'<input id="close_time" type="datetime-local" name="close_time">' +
	'<span class="helptext">VD: 2018-11-16 15:25:33</span>'+
	'</div>' +
	'</div>' +
	'</div></div>' +
	'<div class="modal-footer">' +
	'<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trở Lại</a>' +
	'<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close" onclick="submit_edit_unit('+data.unit+')">Đồng Ý</button>' +
	'</div>' +
	'</form></div></div>';
}

function unit_del_button(data) {
	return btn = '<a class="waves-effect waves-light btn modal-trigger" href="#del-' + data.unit + '">Xóa</a>' +
	'<div id="del-' + data.unit + '" class="modal"><div class="modal-content">' +
	'<h5>Cảnh Báo</h5><p>Xác nhận xóa ' + data.detail + '</p></div>' +
	'<form action="" method="POST" role="form" onsubmit="submit_del_unit(this.id)" id="form-del-unit-' + data.unit + '">' +
	'<div class="modal-footer"><a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a>' +
	'<input type="hidden" value="' + data.unit + '" name="unit">' +
	'<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button></div></form></div>';
}

function select_status () {
	var url = "index.php?action=get_list_statuses";
	var success = function(result) {
		var json_data = $.parseJSON(result);
		var sl = $('select[name=status_id]');
		sl.empty();
		$.each(json_data, function(key, value) {
			sl.append('<option value="'+value.status_id+'">'+value.detail+'</option>');
		});
		$('select').select();
	};
	$.get(url, success);
}
function check_status (id,value) {
	if(value == 3)
	{
		$('#close_time_'+id+'').removeClass('hidden');
	} else {
		$('#close_time_'+id+'').addClass('hidden');
	}
}


function submit_add_unit(data) {
	var url = "index.php?action=check_add_unit";
	var success = function(result) {
		var json_data = $.parseJSON(result);
		show_status(json_data);
		if (json_data.status) {
			unit_insert_data(json_data);
			$('.modal').modal();
			$('select').select();
			select_status();
		}
	};
	$.post(url, data, success);
}

function submit_edit_unit(data) {
	data = $('#form-edit-unit-'+data+'').serializeArray();
	var url = "index.php?action=check_edit_unit";
	var success = function(result) {
		var json_data = $.parseJSON(result);
		show_status(json_data);
		if (json_data.status) {
			$('#unit-' + json_data[0].unit+'').remove();
			unit_insert_data(json_data);
			$('.modal').modal();
		}
	};
	$.post(url, data, success);
}

function submit_del_unit(data) {
	data = $('#' + data).serializeArray();
	var url = "index.php?action=check_del_unit";
	var success = function(result) {
		var json_data = $.parseJSON(result);
		show_status(json_data);
		if (json_data.status) {
			$('#unit-' + json_data.unit).hide('400', function() {
				this.remove();
			});
		}
	};
	$.post(url, data, success);
}
