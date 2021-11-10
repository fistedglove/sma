<?php 
 
 $title = 'Edit Third Term Score';
 
include_once(VIEW_PATH. 'layout/_header.php');

?>

<?php include_once(VIEW_PATH. 'layout/_nav.php'); ?>
<div id = "mainContent">
<div id="studentWarning"><?php echo flash_warning($session->get_message());?></div>
<?php if(!empty($edit_record)):?>

<h3 class="editTitle">Edit Third Term <?php echo $subject;?> Scores for <?php echo $student_name->first_name. '  '. $student_name->surname; ?> </h3>

<form action="<?php echo '/'. APP_ROOT.'/';?>third_term_scores/edit?id=<?php echo $student_name->id;?>&sub=<?php echo $subject;?>" method="post" >
<div id="score">
<fieldset class="score">
<legend>Student Score </legend>
<p><label>Student Name: </label>
<input type="hidden" name="third_term_scores[id]" value="<?php echo $edit_record[0]->id;?>" />
<select name="third_term_scores[student_id]">
<option value="<?php echo $student_name->id;?>"><?php echo $student_name->first_name. ' - '. $student_name->surname; ?></option>
</select>
</p>
<p><label> Subject:</label>
<select name="third_term_scores[subject_name]">
<option value="<?php echo $edit_record[0]->subject_name;?>"><?php echo $edit_record[0]->subject_name;?></option>
</select>
</p>
<p><label> Test Score: </label><input type="text" name="third_term_scores[test_score]" value="<?php echo $edit_record[0]->test_score;?>" /></p>
<p><label> Exam Score: </label><input type="text" name="third_term_scores[exam_score]" value="<?php echo $edit_record[0]->exam_score;?>" /></p>
<p><label> Grade: </label><input type="text" name="third_term_scores[grade]" value="<?php echo $edit_record[0]->grade;?>" /></p>
<p><label> Effort: </label><input type="text" name="third_term_scores[effort]" value="<?php echo $edit_record[0]->effort;?>" /></p>
<p><label> Teacher's Comment: </label><textarea name="third_term_scores[teacher_comment]" cols="25" rows="4" ><?php echo $edit_record[0]->teacher_comment;?></textarea>
<p><input class="submit" type="submit" name="submit"  value="Update"/></p>

</fieldset>
</div>
</form>
<?php endif;?>
</div>
<?php include_once(VIEW_PATH. 'layout/_footer.php'); ?>
