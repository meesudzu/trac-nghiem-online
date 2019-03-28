<div class="title-content">
    <span class="title">Chi Tiết Lớp <span id="class_name_detail"><?=$class_name?></span></span>
</div>
<div class="block-content overflow scrollbar">
    <div class="content">
        <div class="preload hidden" id="preload">
            <img src="res/img/loading.gif" alt="">
        </div>
        <table class="centered striped responsive-table" id="table_classes_detail">
            <thead>
                <tr>
                    <th class="">ID</th>
                    <th class="">Avatar</th>
                    <th class="">Mã Học Sinh</th>
                    <th class="">Tên</th>
                    <th class="">Ngày Sinh</th>
                    <th class="">Giới Tính</th>
                    <th class="">Online Cuối</th>
                    <th class=""><i class="material-icons">settings</i></th>
                </tr>
            </thead>
            <tbody class="scrollbar" id="class_detail">
                <?php
                    foreach ($students as $student) {
                        ?>
                        <tr id="student-id-<?=$student->student_id?>">
                            <td><?=$student->student_id?></td>
                            <td>
                                <img src="upload/avatar/<?=$student->avatar?>" alt="avatar" class="avatar" />
                            </td>
                            <td><?=$student->username?></td>
                            <td><?=$student->name?></td>
                            <td><?=$student->birthday?></td>
                            <td><?=$student->gender_detail?></td>
                            <?php
                            if($student->last_login == '' || $student->last_login == '0000-00-00 00:00:00')
                                $student->last_login = 'Chưa Đăng Nhập';
                            ?>
                            <td><?=$student->last_login?></td>
                            <td>
                                <a class="waves-effect waves-light btn modal-trigger" href="#view_score-<?=$student->student_id?>" onclick="get_score(<?=$student->student_id?>)" id="#view_score-<?=$student->student_id?>">Chi Tiết</a>
                                <div id="view_score-<?=$student->student_id?>" class="modal">
                                    <div class="modal-content">
                                        <h5>Chi tiết điểm học sinh </h5>
                                        <span style="font-weight: bold; font-size: 1.2em"><?=$student->name?></span>
                                    </div>
                                    <div class="modal-body" id="_score-<?=$student->student_id?>"></div>
                                    <div class="modal-footer">
                                        <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trờ Lại</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<script type="text/javascript">
    $('#table_classes_detail').DataTable( {
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
        },
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 7, 1 ] }, //hide sort icon on header of column 7
        ]
    } );
    $('table').on('click', 'a.modal-trigger', function() {
        var elem = document.querySelector(this.id);
        var instance = M.Modal.init(elem);
        var instance = M.Modal.getInstance(elem);
        instance.open();
    });
</script>