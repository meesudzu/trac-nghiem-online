<div class="title-content">
    <span class="title">Sửa Câu Hỏi</span>
    <a href="index.php?action=show_questions_panel" class="cursor"><span class="title">Quản Lý Câu Hỏi</span></a>
</div>
<div class="block-content overflow scrollbar">
    <div class="content">
        <div class="row">
            <div class="col s12">
                <form action="" method="POST" role="form" id="edit_question_form">
                    <div class="col l12 s12" style="padding-top: 20px">
                        <span class="title">Nội Dung Câu Hỏi:</span>
                        <div class="input-field">
                            <textarea id="question_detail" name="question_detail" required><?=$question->question_content?></textarea>
                        </div>
                    </div>
                    <div class="row col l12">
                        <span class="title">Đáp Án A:</span>
                        <div class="input-field">
                            <textarea id="answer_a" name="answer_a" required><?=$question->answer_a?></textarea>
                        </div>
                        <span class="title">Đáp Án B:</span>
                        <div class="input-field">
                            <textarea id="answer_b" name="answer_b"required><?=$question->answer_b?></textarea>
                        </div>
                        <span class="title">Đáp Án C:</span>
                        <div class="input-field">
                            <textarea id="answer_c" name="answer_c" required><?=$question->answer_c?></textarea>
                        </div>
                        <span class="title">Đáp Án D:</span>
                        <div class="input-field">
                            <textarea id="answer_d" name="answer_d" required><?=$question->answer_d?></textarea>
                        </div><br />
                        <div class="input-field">
                            <label for="correct_answer" class="active">Chọn Đáp Án Đúng</label>
                            <select name="correct_answer" id="correct_answer">
                                <?php
                                if($question->correct_answer == $question->answer_a) {
                                    $a = "selected";
                                }
                                if($question->correct_answer == $question->answer_b) {
                                    $b = "selected";
                                }
                                if($question->correct_answer == $question->answer_c) {
                                    $c = "selected";
                                }
                                if($question->correct_answer == $question->answer_d) {
                                    $d = "selected";
                                }
                                 ?>
                                <option value="A" <?=$a?>>A</option>
                                <option value="B" <?=$b?>>B</option>
                                <option value="C" <?=$c?>>C</option>
                                <option value="D" <?=$d?>>D</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <select name="grade_id" id="grade_id">
                                <?php
                                for ($i = 0; $i < count($grades);$i++){
                                    if($grades[$i]->grade_id == $question->grade_id){
                                        echo '<option value="'.$grades[$i]->grade_id.'" selected>'.$grades[$i]->detail.'</option>';
                                    } else {
                                        echo '<option value="'.$grades[$i]->grade_id.'">'.$grades[$i]->detail.'</option>';
                                    }
                                }
                                 ?>
                            </select>
                            <label>Chọn Khối</label>
                        </div>
                        <div class="input-field">
                            <select name="subject_id" id="subject_id">
                                <?php
                                for ($i = 0; $i < count($subjects);$i++){
                                    if($subjects[$i]->subject_id == $question->subject_id){
                                        echo '<option value="'.$subjects[$i]->subject_id.'" selected>'.$subjects[$i]->subject_detail.'</option>';
                                    } else {
                                        echo '<option value="'.$subjects[$i]->subject_id.'">'.$subjects[$i]->subject_detail.'</option>';
                                    }
                                }
                                 ?>
                            </select>
                            <label>Chọn Môn</label>
                        </div>
                        <div class="input-field">
                            <input name="unit" type="number" required="" value="<?=$question->unit?>">
                            <label>Câu Hỏi Thuộc Chương?</label>
                        </div>
                        <div class="input-field">
                            <select name="level_id" id="level_id">
                                <?php
                                if($question->level_id == 1) {
                                    $ez = "selected";
                                }
                                if($question->level_id == 2) {
                                    $nor = "selected";
                                }
                                if($question->level_id == 3) {
                                    $dif = "selected";
                                }
                                 ?>
                                <option value="1" <?=$ez?>>Dễ</option>
                                <option value="2" <?=$nor?>>Trung Bình</option>
                                <option value="3" <?=$dif?>>Khó</option>
                            </select>
                            <label>Độ Khó Câu Hỏi?</label>
                        </div>
                        <input name="question_id" type="hidden" value="<?=$question->question_id?>">
                        <div class="col l12 s12">
                            <button type="submit" class="btn" id="edit_question" name="edit-question">Sửa</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="res/js/edit_question.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('question_detail', {
        extraPlugins: 'mathjax,format',
    });
    CKEDITOR.replace('answer_a', {
        extraPlugins: 'mathjax,format',
    });
    CKEDITOR.replace('answer_b', {
        extraPlugins: 'mathjax,format',
    });
    CKEDITOR.replace('answer_c', {
        extraPlugins: 'mathjax,format',
    });
    CKEDITOR.replace('answer_d', {
        extraPlugins: 'mathjax,format',
    });
    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
</script>
