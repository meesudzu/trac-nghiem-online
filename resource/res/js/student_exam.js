function send_exam (data) {
	$('#preload').removeClass('hidden');
	var url = "index.php?action=send_exam";
	var success = function(result) {
		var json_data = $.parseJSON(result);
		show_result(json_data);
		$('#preload').addClass('hidden');
	};
	$.post(url, data, success);
}

function show_result(data) {
	$('#preload').removeClass('hidden');
	var url = "index.php?action=show_result";
	var success = function(result) {
		$('#box-content').html(result);
		$('#score').html(data.score);
		insert_recent(data);
		$('#preload').addClass('hidden');
	};
	$.get(url, success);
}

function insert_recent (value) {
	var list = $('#recent_list');
	for (var i = 0; i < 10; i++) {
		data = '<span class="exam_quest">Câu '+ (i+1) +' <span class="exam_small">#'+ value[i].ID +'</span>: </span>'+
		'<span class="exam_detail">'+ value[i].question_detail +'</span>'+
		'<input type="hidden" name="quest_'+ i +'_id" value="'+ value[i].ID +'" />'+
		'<div class="exam_ans">';
		if(value[i].answer == value[i].answer_a)
			data += '<label><input value="'+ value[i].answer_a +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" checked disabled/>'+
		'<span>'+ value[i].answer_a +'</span></label>';
		else
			data += '<label><input value="'+ value[i].answer_a +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" disabled />'+
		'<span>'+ value[i].answer_a +'</span></label>';
		if(value[i].answer == value[i].answer_b)
			data += '<label><input value="'+ value[i].answer_b +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" checked disabled/>'+
		'<span>'+ value[i].answer_b +'</span></label>';
		else
			data += '<label><input value="'+ value[i].answer_b +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" disabled />'+
		'<span>'+ value[i].answer_b +'</span></label>';
		if(value[i].answer == value[i].answer_c)
			data += '<label><input value="'+ value[i].answer_c +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" checked disabled/>'+
		'<span>'+ value[i].answer_c +'</span></label>';
		else
			data += '<label><input value="'+ value[i].answer_c +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" disabled />'+
		'<span>'+ value[i].answer_c +'</span></label>';
		if(value[i].answer == value[i].answer_d)
			data += '<label><input value="'+ value[i].answer_d +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" checked disabled/>'+
		'<span>'+ value[i].answer_d +'</span></label></div>';
		else
			data += '<label><input value="'+ value[i].answer_d +'" class="with-gap" name="quest_'+ i +'_answer" type="radio" disabled />'+
		'<span>'+ value[i].answer_d +'</span></label></div>';
		data += '<span class="exam_quest">Đáp án: '+ value[i].correct_answer +'</span><br />';
		list.append(data);
	};
}