<?php

$title = 'New First Term Comment';

include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/Teacher/_nav.php');?>


<div id = "mainContent">

<h3 class="title">Class Teacher's First Term Comment</h3>
<?php if($session->get_message() =='Successfully Created Comment!'):?>
<div class="newGreenCommentMsg"><?php echo flash_warning($session->get_message());?></div>
<?php elseif($session->get_message() !='Successfully Created Comment!'):?>
<div class="newCommentMsg"><?php echo flash_warning($session->get_message());?></div>
<?php endif;?>
<div id="comment">

<div  class="one">
<form action="<?php echo '/'. APP_ROOT.'/';?>first_term_comments/new?id=<?php echo $class->id;?>" method="post">
<fieldset>
<p><label>Class:</label>
<select name="first_term_comments[0][class_id]">
<option value="<?php echo $class->id;?>"><?php echo strtoupper($class->title);?></option>
</select>
</p>

<p>
<label>Student</label>
<select name="first_term_comments[0][student_id]">
<option value="">Select Student</option>
<?php foreach($class_students as $student):?>
<option value="<?php echo $student->id;?>"><?php echo  htmlspecialchars(strtoupper($student->surname . ' - '. $student->first_name. ' - '. $student->other_names));?></option>
<?php endforeach;?>
</select>
</p>
<p>
<label>Attendance</label>
<input type="text" name="first_term_comments[0][attendance]" value="" />
</p>
<p>
<label>Comment</label>
<textarea name="first_term_comments[0][remark]" cols="22" rows="4" maxlength="100"></textarea>
</p>
</fieldset>
</div>

<div class="two">
<fieldset>
<p><label>Class:</label>
<select name="first_term_comments[1][class_id]">
<option value="<?php echo $class->id;?>"><?php echo strtoupper($class->title);?></option>
</select>
</p>

<p>
<label>Student</label>
<select name="first_term_comments[1][student_id]">
<option value="">Select Student</option>
<?php foreach($class_students as $student):?>
<option value="<?php echo $student->id;?>"><?php echo $student->surname . ' - '. $student->first_name. ' - '. $student->other_names;?></option>
<?php endforeach;?>
</select>
</p>
<p>
<label>Attendance</label>
<input type="text" name="first_term_comments[1][attendance]" value="" />
</p>
<p>
<label>Comment</label>
<textarea name="first_term_comments[1][remark]" cols="22" rows="4" maxlength="100"></textarea>
</p>
</fieldset>
</div>

<div class="three">
<fieldset>
<p><label>Class:</label>
<select name="first_term_comments[2][class_id]">
<option value="<?php echo $class->id;?>"><?php echo strtoupper($class->title);?></option>
</select>
</p>

<p>
<label>Student</label>
<select name="first_term_comments[2][student_id]">
<option value="">Select Student</option>
<?php foreach($class_students as $student):?>
<option value="<?php echo $student->id;?>"><?php echo $student->surname . ' - '. $student->first_name. ' - '. $student->other_names;?></option>
<?php endforeach;?>
</select>
</p>
<p>
<label>Attendance</label>
<input type="text" name="first_term_comments[2][attendance]" value="" />
</p>
<p>
<label>Comment</label>
<textarea name="first_term_comments[2][remark]" cols="22" rows="4" maxlength="100"></textarea>
</p>
</fieldset>
</div>

<div class="four">
<fieldset>
<p><label>Class:</label>
<select name="first_term_comments[3][class_id]">
<option value="<?php echo $class->id;?>"><?php echo strtoupper($class->title);?></option>
</select>
</p>

<p>
<label>Student</label>
<select name="first_term_comments[3][student_id]">
<option value="">Select Student</option>
<?php foreach($class_students as $student):?>
<option value="<?php echo $student->id;?>"><?php echo $student->surname . ' - '. $student->first_name. ' - '. $student->other_names;?></option>
<?php endforeach;?>
</select>
</p>
<p>
<label>Attendance</label>
<input type="text" name="first_term_comments[3][attendance]" value="" />
</p>
<p>
<label>Comment</label>
<textarea name="first_term_comments[3][remark]" cols="22" rows="4" maxlength="100"></textarea>
</p>
</fieldset>
</div>
<p><input class="submit" type="submit" name="submit" value="Submit" /></p>
</form>

</div>

</div>

<?php include_once(VIEW_PATH. 'layout/_footer.php');?>
