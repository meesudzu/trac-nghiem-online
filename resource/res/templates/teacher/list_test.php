<div class="title-content">
	<span class="title">Danh Sách Bài Thi</span>
</div>
<div class="block-content overflow scrollbar">
	<div class="content">
		<div class="preload hidden" id="preload">
			<img src="res/img/loading.gif" alt="">
		</div>
		<table class="striped centered responsive-table" id="tests">
			<thead>
				<tr>
					<th class="">Tên</th>
					<th class="">Mã Đề</th>
					<th class="">Môn</th>
					<th class="">Khối</th>
					<th class="">Thông Tin</th>
					<th class=""><i class="material-icons">settings</i></th>
				</tr>
			</thead>
			<tbody id="list_tests">
				<?php

				for ($i = 0; $i < count($tests); $i++) {
					?>
					<tr>
						<td><?=$tests[$i]->test_name?></td>
						<td><?=$tests[$i]->test_code?></td>
						<td><?=$tests[$i]->subject_detail?></td>
						<td><?=$tests[$i]->grade?></td>
						<td><?=$tests[$i]->total_questions?> câu hỏi, thời gian <?=$tests[$i]->time_to_do?> phút</td>
						<td><a href="diem-de-thi-<?=$tests[$i]->test_code?>" class="btn">Xem Điểm</a></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
</div>
<script src="res/libs/DataTables/js/jquery.dataTables.js"></script>
<script>
	$('#tests').DataTable( {
		"language": {
			"lengthMenu": "Hiển thị _MENU_",
			"zeroRecords": "Không tìm thấy",
			"info": "Hiển thị trang _PAGE_/_PAGES_",
			"infoEmpty": "Không có dữ liệu",
			"emptyTable": "Không có dữ liệu",
			"infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
			"sSearch": "Tìm kiếm",
			"paginate": {
				"first":      "Đầu",
				"last":       "Cuối",
				"next":       "Sau",
				"previous":   "Trước"
			},
		}
    } );
</script>