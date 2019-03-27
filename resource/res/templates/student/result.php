	<div class="title-content">
		<span class="title">Kết Quả Bài Làm <?=$test_code?></span>
	</div>
	<div class="block-content overflow scrollbar">
		<div class="content">
			<div class="preload hidden" id="preload">
				<img src="res/img/loading.gif" alt="">
			</div>
			<div id="recent_list" style="padding-bottom: 20px;">
				<span class="title" style="color: #02796e;"><?=$score->score_number?> Điểm</span><br />
				<span class="title" style="color: #02796e;">Đúng <?=$score->score_detail?> Câu</span><br />
				<span class="title">Hoàn Thành Lúc: <?=$score->completion_time?></span><br />
				<span class="title">CHI TIẾT BÀI THI</span><br />
                <span class="title">Chú thích:<br />
                    <span style="color: green;">Màu xanh </span>là học sinh chọn đúng đáp án <br />
                    <span style="color: red;">Màu đỏ </span> là đáp án học sinh chọn sai<br />
                    <span style="color: blue;">Màu xanh dương </span> là đáp án đúng của câu hỏi
                </span>
                <hr>
            </div>
            <div id="recent">
                <?php
                if($result == null) {
                    echo '<span class="title">Bài Thi/Kiểm tra chưa được mở xem đáp án. Vui lòng liên hệ Giáo viên hoặc Quản trị viên.</span>';
                } else {

                 for($i = 0; $i < count($result); $i++) {
                    ?>
                    <div id="quest-<?=($i+1)?>" class="item-quest">
                        <div class="quest-title">Câu <?=($i+1)?>:</div>
                        <div class="quest-content">
                            <span><?=$result[$i]->question_content?></span>
                        </div>
                        <div class="quest-answer">
                            <div class='answer'>
                                <?php
                                if (trim($result[$i]->student_answer) == trim($result[$i]->answer_a) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
                                {
                                    echo '<input name="" type="radio" checked disabled />
                                    <span style="color:green;" class="correct">'.$result[$i]->answer_a.'</span>';
                                }
                                else
                                {
                                    if (trim($result[$i]->student_answer) == trim($result[$i]->answer_a) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
                                    {
                                        echo '<input name="" type="radio" checked disabled />
                                        <span style="color:red;" class="incorrect">'.$result[$i]->answer_a.'</span>';
                                    }
                                    else
                                    {
                                        if (trim($result[$i]->answer_a) == trim($result[$i]->correct_answer))
                                        {
                                            echo '<input name="" type="radio" checked disabled />
                                            <span style="color:blue;" class="notanswer">'.$result[$i]->answer_a.'</span>';
                                        }
                                        else
                                        {
                                            echo '<input name="" type="radio" disabled />
                                            <span>'.$result[$i]->answer_a.'</span>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class='answer'>
                                <?php
                                if (trim($result[$i]->student_answer) == trim($result[$i]->answer_b) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
                                {
                                    echo '<input name="" type="radio" checked disabled />
                                    <span style="color:green" class="correct">'.$result[$i]->answer_b.'</span>';
                                }
                                else
                                {
                                    if (trim($result[$i]->student_answer) == trim($result[$i]->answer_b) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
                                    {
                                        echo '<input name="" type="radio" checked disabled />
                                        <span style="color:red" class="incorrect">'.$result[$i]->answer_b.'</span>';
                                    }
                                    else
                                    {
                                        if (trim($result[$i]->answer_b) == trim($result[$i]->correct_answer))
                                        {
                                            echo '<input name="" type="radio" checked disabled />
                                            <span style="color:blue" class="notanswer">'.$result[$i]->answer_b.'</span>';
                                        }
                                        else
                                        {
                                            echo '<input name="" type="radio" disabled />
                                            <span>'.$result[$i]->answer_b.'</span>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class='answer'>
                                <?php
                                if (trim($result[$i]->student_answer) == trim($result[$i]->answer_c) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
                                {
                                    echo '<input name="" type="radio" checked disabled />
                                    <span style="color:green" class="correct">'.$result[$i]->answer_c.'</span>';
                                }
                                else
                                {
                                    if (trim($result[$i]->student_answer) == trim($result[$i]->answer_c) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
                                    {
                                        echo '<input name="" type="radio" checked disabled />
                                        <span style="color:red" class="incorrect">'.$result[$i]->answer_c.'</span>';
                                    }
                                    else
                                    {
                                        if (trim($result[$i]->answer_c) == trim($result[$i]->correct_answer))
                                        {
                                            echo '<input name="" type="radio" checked disabled />
                                            <span style="color:blue" class="notanswer">'.$result[$i]->answer_c.'</span>';
                                        }
                                        else
                                        {
                                            echo '<input name="" type="radio" disabled />
                                            <span>'.$result[$i]->answer_c.'</span>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class='answer'>
                                <?php
                                if (trim($result[$i]->student_answer) == trim($result[$i]->answer_d) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
                                {
                                    echo '<input name="" type="radio" checked disabled />
                                    <span style="color:green" class="correct">'.$result[$i]->answer_d.'</span>';
                                }
                                else
                                {
                                    if (trim($result[$i]->student_answer) == trim($result[$i]->answer_d) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
                                    {
                                        echo '<input name="" type="radio" checked disabled />
                                        <span style="color:red" class="incorrect">'.$result[$i]->answer_d.'</span>';
                                    }
                                    else
                                    {
                                        if (trim($result[$i]->answer_d) == trim($result[$i]->correct_answer))
                                        {
                                            echo '<input name="" type="radio" checked disabled />
                                            <span style="color:blue" class="notanswer">'.$result[$i]->answer_d.'</span>';
                                        }
                                        else
                                        {
                                            echo '<input name="" type="radio" disabled />
                                            <span>'.$result[$i]->answer_d.'</span>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
</div>
<script src='res/libs/MathJax/MathJax.js?config=TeX-MML-AM_CHTML' async></script>