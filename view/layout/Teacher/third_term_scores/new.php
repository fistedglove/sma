<?php 
 
$title = 'New Third Term Score';

include_once(VIEW_PATH. 'layout/_header.php');

?>

<?php include_once(VIEW_PATH. 'layout/_nav.php'); ?>
<div id = "mainContent">

<?php if(!empty($stud)):?>

<h3 class="parentTitle">Third Term Result Scores for <?php echo htmlspecialchars(ucwords($stud->surname. '  '. $stud->first_name));  ?></h3>


<div class="newScoreMsg"><?php echo flash_warning($session->get_message());?></div>
<form action="<?php echo '/'. APP_ROOT.'/';?>third_term_scores/new?id=<?php echo $id;?>" method="post" class = "result">

<fieldset class="score">
<legend>Student Score </legend>
<p><label>Student Name: </label>
<select name="third_term_scores[student_id]">
<option value="<?php echo $stud->id;?>"><?php echo htmlspecialchars(strtoupper($stud->surname. ' - '. $stud->first_name));  ?></option>
</select>
</p>

<p><label> Subject:</label>
<select name="third_term_scores[subject_name]">
<option value="">Select a Subject</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo $subject->subject_title; ?>"><?php echo htmlspecialchars(strtoupper($subject->subject_title)); ?></option>
<?php endforeach;?>
</select>
</p>
<p><label> Test Score: </label><input type="text" name="third_term_scores[test_score]" value="" /></p>
<p><label> Exam Score: </label><input type="text" name="third_term_scores[exam_score]" value="" /></p>
<p><label> Grade: </label><input type="text" name="third_term_scores[grade]" value="" /></p>
<p><label> Effort: </label><input type="text" name="third_term_scores[effort]" value="" /></p>
<p><label> Teacher's Comment: </label><textarea name="third_term_scores[teacher_comment]" cols="25" rows="4" ></textarea>
<p><input class="submit" type="submit" name="submit"  value="Submit"/></p>

</fieldset>
</form>
<?php else:?>
<div id="emptyResult">

<h3>No Student Selected!</h3>
</div>
<?php endif;?>
</div>
<?php include_once(VIEW_PATH. 'layout/_footer.php'); ?>
