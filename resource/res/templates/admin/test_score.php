<div class="title-content">
	<span class="title">Danh Sách Điểm Bài Thi <?=$test_code?></span>
	<a class="title" href="xuat-diem-de-thi-<?=$test_code?>">Xuất File Excel</a>
</div>
<div class="block-content overflow scrollbar">
	<div class="content">
		<div class="preload hidden" id="preload">
			<img src="res/img/loading.gif" alt="">
		</div>
		<table class="striped centered responsive-table" id="scores">
			<thead>
				<tr>
					<th class="">STT</th>
					<th class="">Tên</th>
					<th class="">Tài Khoản</th>
					<th class="">Lớp</th>
					<th class="">Điểm</th>
				</tr>
			</thead>
			<tbody>
				<?php
				for($i = 0; $i < count($scores); $i++) {
					?>
					<tr>
						<td><?=($i+1)?></td>
						<td><?=$scores[$i]->name?></td>
						<td><?=$scores[$i]->username?></td>
						<td><?=$scores[$i]->class_name?></td>
						<td><?=$scores[$i]->score_number?></td>
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
	$('#scores').DataTable( {
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