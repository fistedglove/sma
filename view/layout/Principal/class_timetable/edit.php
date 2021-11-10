<?php

$title = 'Edit Class Timetable';

include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/Principal/_nav.php');?>

<div id = "mainContent">
<?php echo flash_warning($session->get_message());?>
<h3 class="title">Edit Class Schedule</h3>
<div  class="mainArticle">
<form action="<?php echo '/'. APP_ROOT.'/';?>class_timetable/edit?id=<?php echo $class_id;?>&period=<?php echo $period_id;?>" method="post">
<div class="mon">
<fieldset id="schedule">
<legend>Mondays Schedule</legend>
<p><label>Period</label>
<select name="mon[periods]">
<option value="<?php echo $period_id;?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['period_title'])); ?></option>

</select>
</p>
<p>
<label>Class</label>
<select name="mon[class]">
<option value="<?php echo $class_id;?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['title']));?></option>
</select>
</p>
<p><label>Subject</label>
<select name="mon[subject]">
<option value="<?php echo $edit_record[0]['mon'];?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['mon'])); ?></option>
<option value="Free">FREE</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo $subject['subject_title'];?>"><?php echo htmlspecialchars(strtoupper($subject['subject_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Teacher</label>
<select name="mon[teacher]">
<option value="<?php echo $mon_teacher_id;?>"><?php echo htmlspecialchars(ucwords($mon_teacher_name));?></option>
<option value="NULL">NULL</option>
<?php foreach($teachers as $teacher):?>
<option value="<?php echo $teacher->id;?>"><?php echo htmlspecialchars(ucwords($teacher->full_name));?></option>
<?php endforeach;?>
</select>
</p>
</fieldset>
</div>
<div class="tue">
<fieldset id="schedule">
<legend>Tuedays Schedule</legend>
<p><label>Period</label>
<select name="tue[periods]">
<option value="<?php echo $period_id;?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['period_title'])); ?></option>

</select>
</p>
<p><label>Class</label>
<select name="tue[class]">
<option value="<?php echo $class_id;?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['title']));?></option>
</select>
</p>
<p><label>Subject</label>
<select name="tue[subject]">
<option value="<?php echo $edit_record[0]['tue'];?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['tue'])); ?></option>
<option value="Free">FREE</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo $subject['subject_title'];?>"><?php echo htmlspecialchars(strtoupper($subject['subject_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Teacher</label>
<select name="tue[teacher]">
<option value="<?php echo $tue_teacher_id;?>"><?php echo htmlspecialchars(ucwords($tue_teacher_name));?></option>
<option value="NULL">NULL</option>
<?php foreach($teachers as $teacher):?>
<option value="<?php echo $teacher->id;?>"><?php echo htmlspecialchars(ucwords($teacher->full_name));?></option>
<?php endforeach;?>
</select>
</p>
</fieldset>
</div>


<div class="wed">
<fieldset id="schedule">
<legend>Wednesdays Schedule</legend>
<p><label>Period</label>
<select name="wed[periods]">
<option value="<?php echo $period_id;?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['period_title'])); ?></option>

</select>
</p>
<p><label>Class</label>
<select name="wed[class]">
<option value="<?php echo $class_id;?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['title']));?></option>

</select>
</p>
<p><label>Subject</label>
<select name="wed[subject]">
<option value="<?php echo $edit_record[0]['wed'];?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['wed'])); ?></option>
<option value="Free">FREE</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo $subject['subject_title'];?>"><?php echo htmlspecialchars(strtoupper($subject['subject_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Teacher</label>
<select name="wed[teacher]">
<option value="<?php echo $wed_teacher_id;?>"><?php echo htmlspecialchars(ucwords($wed_teacher_name));?></option>
<option value="NULL">NULL</option>
<?php foreach($teachers as $teacher):?>
<option value="<?php echo $teacher->id;?>"><?php echo htmlspecialchars(ucwords($teacher->full_name));?></option>
<?php endforeach;?>
</select>
</p>
</fieldset>
</div>

<div class="thur">
<fieldset id="schedule">
<legend>Thursdays Schedule</legend>
<p><label>Period</label>
<select name="thur[periods]">
<option value="<?php echo $period_id;?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['period_title'])); ?></option>

</select>
</p>
<p><label>Class</label>
<select name="thur[class]">
<option value="<?php echo $class_id;?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['title']));?></option>

</select>
</p>
<p><label>Subject</label>
<select name="thur[subject]">
<option value="<?php echo $edit_record[0]['thur'];?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['thur'])); ?></option>
<option value="Free">FREE</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo $subject['subject_title'];?>"><?php echo htmlspecialchars(strtoupper($subject['subject_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Teacher</label>
<select name="thur[teacher]">
<option value="<?php echo $thur_teacher_id;?>"><?php echo htmlspecialchars(ucwords($thur_teacher_name));?></option>
<option value="NULL">NULL</option>
<?php foreach($teachers as $teacher):?>
<option value="<?php echo $teacher->id;?>"><?php echo htmlspecialchars(ucwords($teacher->full_name));?></option>
<?php endforeach;?>
</select>
</p>
</fieldset>
</div>

<div class="fri">
<fieldset id="schedule">
<legend>Fridays Schedule</legend>
<p><label>Period</label>
<select name="fri[periods]">
<option value="<?php echo $period_id;?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['period_title'])); ?></option>

</select>
</p>
<p><label>Class</label>
<select name="fri[class]">
<option value="<?php echo $class_id;?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['title']));?></option>

</select>
</p>
<p><label>Subject</label>
<select name="fri[subject]">
<option value="<?php echo $edit_record[0]['fri'];?>"><?php echo htmlspecialchars(strtoupper($edit_record[0]['fri'])); ?></option>
<option value="Free">FREE</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo $subject['subject_title'];?>"><?php echo htmlspecialchars(strtoupper($subject['subject_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Teacher</label>
<select name="fri[teacher]">
<option value="<?php echo $fri_teacher_id;?>"><?php echo htmlspecialchars(ucwords($fri_teacher_name));?></option>
<option value="NULL">NULL</option>
<?php foreach($teachers as $teacher):?>
<option value="<?php echo $teacher->id;?>"><?php echo htmlspecialchars(ucwords($teacher->full_name));?></option>
<?php endforeach;?>
</select>
</p>
</fieldset>
</div>
<p class="update"><input class="update" type="submit" name="submit" value="Update" /></p>
</div>


</form>
</div>



<?php include_once(VIEW_PATH. 'layout/_footer.php');?>
