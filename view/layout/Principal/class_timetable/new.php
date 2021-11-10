<?php

$title = 'New Timetable';
include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/Principal/_nav.php');?>

<div id = "mainContent">
<div class="newTimetableMsg"><?php echo flash_message($session->get_message());?></div>
<h3 class="title">Create Class Schedule</h3>
<div  class="mainArticle">
<form action="<?php echo '/'. APP_ROOT.'/';?>class_timetable/new" method="post">
<div class="mon">
<fieldset id="schedule">
<legend>Mondays Schedule</legend>
<p><label>Period Title</label>
<select name="mon[periods]">
<option value="">Select period</option>
<?php foreach($periods as $period):?>
<option value="<?php echo $period['id'];?>"><?php echo htmlspecialchars(strtoupper($period['period_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p>
<label>Class</label>
<select name="mon[class]">
<option value="<?php echo $record['id'];?>"><?php echo strtoupper($record['title']);?></option>
</select>
</p>
<p><label>Subject</label>
<select name="mon[subject]">
<option value="">Select Subject</option>
<option value="Free">FREE</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo $subject['subject_title'];?>"><?php echo htmlspecialchars(strtoupper($subject['subject_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Teacher</label>
<select name="mon[teacher]">
<option value="">Select Teacher</option>
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
<p><label>Period Title</label>
<select name="tue[periods]">
<option value="">Select period</option>
<?php foreach($periods as $period):?>
<option value="<?php echo $period['id'];?>"><?php echo htmlspecialchars(strtoupper($period['period_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Class</label>
<select name="tue[class]">
<option value="<?php echo $record['id'];?>"><?php echo strtoupper($record['title']);?></option>
</select>
</p>
<p><label>Subject</label>
<select name="tue[subject]">
<option value="">Select Subject</option>
<option value="Free">FREE</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo $subject['subject_title'];?>"><?php echo htmlspecialchars(strtoupper($subject['subject_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Teacher</label>
<select name="tue[teacher]">
<option value="">Select Teacher</option>
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
<p><label>Period Title</label>
<select name="wed[periods]">
<option value="">Select period</option>
<?php foreach($periods as $period):?>
<option value="<?php echo $period['id'];?>"><?php echo htmlspecialchars(strtoupper($period['period_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Class</label>
<select name="wed[class]">
<option value="<?php echo $record['id'];?>"><?php echo strtoupper($record['title']);?></option>
</select>
</p>
<p><label>Subject</label>
<select name="wed[subject]">
<option value="">Select Subject</option>
<option value="Free">FREE</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo $subject['subject_title'];?>"><?php echo htmlspecialchars(strtoupper($subject['subject_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Teacher</label>
<select name="wed[teacher]">
<option value="">Select Teacher</option>
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
<p><label>Period Title</label>
<select name="thur[periods]">
<option value="">Select period</option>
<?php foreach($periods as $period):?>
<option value="<?php echo $period['id'];?>"><?php echo htmlspecialchars(strtoupper($period['period_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Class</label>
<select name="thur[class]">
<option value="<?php echo $record['id'];?>"><?php echo strtoupper($record['title']);?></option>
</select>
</p>
<p><label>Subject</label>
<select name="thur[subject]">
<option value="">Select Subject</option>
<option value="Free">FREE</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo $subject['subject_title'];?>"><?php echo htmlspecialchars(strtoupper(htmlspecialchars(strtoupper($subject['subject_title']))));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Teacher</label>
<select name="thur[teacher]">
<option value="">Select Teacher</option>
<option value="NULL">NULL</option>
<?php foreach($teachers as $teacher):?>
<option value="<?php echo $teacher->id;?>"><?php echo htmlspecialchars(strtoupper(htmlspecialchars(ucwords($teacher->full_name))));?></option>
<?php endforeach;?>
</select>
</p>
</fieldset>
</div>

<div class="fri">
<fieldset id="schedule">
<legend>Fridays Schedule</legend>
<p><label>Period Title</label>
<select name="fri[periods]">
<option value="">Select period</option>
<?php foreach($periods as $period):?>
<option value="<?php echo $period['id'];?>"><?php echo htmlspecialchars(strtoupper($period['period_title']));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Class</label>
<select name="fri[class]">
<option value="<?php echo $record['id'];?>"><?php echo strtoupper($record['title']);?></option>
</select>
</p>
<p><label>Subject</label>
<select name="fri[subject]">
<option value="">Select Subject</option>
<option value="Free">FREE</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo $subject['subject_title'];?>"><?php echo htmlspecialchars(strtoupper(htmlspecialchars(strtoupper($subject['subject_title']))));?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Teacher</label>
<select name="fri[teacher]">
<option value="">Select Teacher</option>
<option value="NULL">NULL</option>
<?php foreach($teachers as $teacher):?>
<option value="<?php echo $teacher->id;?>"><?php echo htmlspecialchars(ucwords($teacher->full_name));?></option>
<?php endforeach;?>
</select>
</p>
</fieldset>
</div>
<p class="update"><input class="update" type="submit" name="submit" value="Create" /></p>
</div>


</form>
</div>



<?php include_once(VIEW_PATH. 'layout/_footer.php');?>
