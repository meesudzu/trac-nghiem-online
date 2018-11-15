<div class="title-content">
	<span class="title">Chi Tiết Đề Thi</span>
</div>
<div class="block-content overflow scrollbar">
	<div class="content">
		<div class="preload hidden" id="preload">
			<img src="res/img/loading.gif" alt="">
		</div>
		<table class="striped centered responsive-table" id="questions">
			<thead>
				<tr>
					<th class="">ID</th>
					<th class="">Nội Dung Câu Hỏi</th>
					<th class="">Đáp Án</th>
				</tr>
			</thead>
			<tbody>
				<?php
				for($i = 0; $i < count($questions); $i++) {
					?>
					<tr>
						<td><?=$questions[$i]->question_id?></td>
						<td><?=$questions[$i]->question_content?></td>
						<td><?=$questions[$i]->correct_answer?></td>
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
	$('#questions').DataTable( {
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