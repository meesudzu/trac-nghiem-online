	<div class="title-content">
		<span class="title">Kết Quả Bài Làm <?=$result[0]->test_code?></span>
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
				<span class="title">CHI TIẾT BÀI THI</span>
				<hr>
			</div>
			<div id="recent">
				<?php
			for($i = 0; $i < count($result); $i++) {
				?>
				<div id="quest-<?=($i+1)?>" class="item-quest">
                <div class="quest-title">Câu <?=($i+1)?>:</div>
                <div class="quest-content">
                    <span><?=$result[$i]->question_content?></span>
                </div>
                <div class="quest-answer">
                    <p>
                        <label>
                        	<?php
                            if (trim($result[$i]->student_answer) == trim($result[$i]->answer_a) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
                            {
                                echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                <span style="color:green">'.$result[$i]->answer_a.'</span>';
                            }
                            else
                            {
                                if (trim($result[$i]->student_answer) == trim($result[$i]->answer_a) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
                                {
                                    echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                    <span style="color:red">'.$result[$i]->answer_a.'</span>';
                                }
                                else
                                {
                                    if (trim($result[$i]->answer_a) == trim($result[$i]->correct_answer))
                                    {
                                        echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                        <span style="color:green">'.$result[$i]->answer_a.'</span>';
                                    }
                                    else
                                    {
                                        echo '<input name="'.$result[$i]->question_id.'" type="radio" disabled />
                                        <span>'.$result[$i]->answer_a.'</span>';
                                    }
                                }
                            }
                            ?>
                        </label>
                    </p>
                    <p>
                        <label>
                            <?php
                            if (trim($result[$i]->student_answer) == trim($result[$i]->answer_b) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
                            {
                                echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                <span style="color:green">'.$result[$i]->answer_b.'</span>';
                            }
                            else
                            {
                                if (trim($result[$i]->student_answer) == trim($result[$i]->answer_b) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
                                {
                                    echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                    <span style="color:red">'.$result[$i]->answer_b.'</span>';
                                }
                                else
                                {
                                    if (trim($result[$i]->answer_b) == trim($result[$i]->correct_answer))
                                    {
                                        echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                        <span style="color:green">'.$result[$i]->answer_b.'</span>';
                                    }
                                    else
                                    {
                                        echo '<input name="'.$result[$i]->question_id.'" type="radio" disabled />
                                        <span>'.$result[$i]->answer_b.'</span>';
                                    }
                                }
                            }
                            ?>
                        </label>
                    </p>
                    <p>
                        <label>
                            <?php
                            if (trim($result[$i]->student_answer) == trim($result[$i]->answer_c) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
                            {
                                echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                <span style="color:green">'.$result[$i]->answer_c.'</span>';
                            }
                            else
                            {
                                if (trim($result[$i]->student_answer) == trim($result[$i]->answer_c) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
                                {
                                    echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                    <span style="color:red">'.$result[$i]->answer_c.'</span>';
                                }
                                else
                                {
                                    if (trim($result[$i]->answer_c) == trim($result[$i]->correct_answer))
                                    {
                                        echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                        <span style="color:green">'.$result[$i]->answer_c.'</span>';
                                    }
                                    else
                                    {
                                        echo '<input name="'.$result[$i]->question_id.'" type="radio" disabled />
                                        <span>'.$result[$i]->answer_c.'</span>';
                                    }
                                }
                            }
                            ?>
                        </label>
                    </p>
                    <p>
                        <label>
                            <?php
                            if (trim($result[$i]->student_answer) == trim($result[$i]->answer_d) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
                            {
                                echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                <span style="color:green">'.$result[$i]->answer_d.'</span>';
                            }
                            else
                            {
                                if (trim($result[$i]->student_answer) == trim($result[$i]->answer_d) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
                                {
                                    echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                    <span style="color:red">'.$result[$i]->answer_d.'</span>';
                                }
                                else
                                {
                                    if (trim($result[$i]->answer_d) == trim($result[$i]->correct_answer))
                                    {
                                        echo '<input name="'.$result[$i]->question_id.'" type="radio" checked disabled />
                                        <span style="color:green">'.$result[$i]->answer_d.'</span>';
                                    }
                                    else
                                    {
                                        echo '<input name="'.$result[$i]->question_id.'" type="radio" disabled />
                                        <span>'.$result[$i]->answer_d.'</span>';
                                    }
                                }
                            }
                            ?>
                        </label>
                    </p>
                </div>
            </div>
				<?php
			}
			?>
			</div>
		</div>
	</div>
</div>