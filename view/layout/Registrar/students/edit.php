<?php

$title = 'Edit Student';

include_once(VIEW_PATH. 'layout/_header.php');
?>

<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>

<div id = "mainContent">

<h3 class="studentTitle"><p> Edit Profile for <?php echo htmlspecialchars (ucfirst(strtolower($student->surname))). '  ' . htmlspecialchars(ucfirst(strtolower($student->first_name))) ?></p></h3>

<div id="studentWarning"><?php echo flash_warning($session->get_message());?></div>

<form action="<?php echo '/'. APP_ROOT.'/';?>students/edit?id=<?php echo $student->id; ?>" method="post" enctype="multipart/form-data">
<fieldset class="editStudent">
<legend>Student Details</legend>

<input type="hidden" name="students[id]" value="<?php echo $student->id; ?>" />
<p><label>Surname</label><input name = "students[surname]" type="text" value="<?php echo htmlspecialchars(strtoupper($student->surname)); ?>" /></p>
<p><label>First Name</label><input name = "students[first_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($student->first_name)); ?>"  /></p>
<p><label>Other Names</label><input name = "students[other_names]" type="text" value="<?php echo htmlspecialchars (strtoupper($student->other_names)); ?>"  /></p>
<p><label>Date of Birth</label><input name = "students[dob]" id="date" type="text" value="<?php echo htmlspecialchars (strtoupper(displayed_date($student->dob))); ?>"  /></p>
<p>
<label>Gender</label>
<?php if($student->gender == 'Male'):?>
<input class="radio" name ="students[gender]" type="radio" checked="checked" value="Male" /> Male&nbsp;&nbsp;&nbsp;&nbsp;
<input class="radio" name="students[gender]" type="radio"  value="Female" />Female
<?php elseif($student->gender == 'Female'):?>
<input class="radio" name ="students[gender]" type="radio" value="Male" /> Male&nbsp;&nbsp;&nbsp;&nbsp;
<input class="radio" name="students[gender]" type="radio" checked="checked" value="Female" />Female
<?php endif;?>
</p>
<p><label>Nationality</label><input name = "students[nationality]" type="text" value="<?php echo htmlspecialchars (strtoupper($student->nationality)); ?>"  /></p>
<p><label>Parent</label>
<select name="students[parent_id]">
<option value="<?php echo $student->parent_id; ?>"><?php $parent = Parents::find_by_id($student->parent_id); echo htmlspecialchars (strtoupper( $parent->full_name));?></option>
</select>
</p>
<p><label>Class</label>
<select name="students[class_id]">
<option value="<?php echo $student->class_id; ?>"><?php $class = classes::find_by_id($student->class_id); echo htmlspecialchars (strtoupper( $class->title));?></option>
<?php foreach ($classes as $class): ?>
<option value="<?php echo $class->id; ?>"><?php echo htmlspecialchars($class->title); ?></option>
<?php endforeach;?>
</select>
</p>
<p><label>House</label>
<select name="students[house_id]">
<option value="<?php echo $student->house_id; ?>"><?php $house = houses::find_by_id($student->house_id); echo htmlspecialchars (strtoupper( $house->house_title));?></option>
<?php foreach ($houses as $house): ?>
<option value="<?php echo $house->id; ?>"><?php echo htmlspecialchars (strtoupper($house->house_title)); ?></option>
<?php endforeach;?>
</select>
</p>
<input name = "students[admission_date]" type="hidden" value="<?php echo $student->admission_date; ?>"  /></p>
<p>
<label>Status</label>
<?php if($student->status == 'Active'):?>
<input class="radio" name ="students[status]" type="radio" checked="checked" value="active" />Active&nbsp;
<input class="radio" name="students[status]" type="radio"  value="Inactive" />Inactive
<?php elseif($student->status == 'Inactive'):?>
<input class="radio" name ="students[status]" type="radio" value="active" /> Active&nbsp;
<input class="radio" name="students[status]" type="radio" checked="checked" value="inactive" />Inactive
<?php endif;?>
</p>

<p><label>Graduation Date</label><input name = "students[grad_year]" id="dat" type="text" value="<?php if($student->grad_year != null && (int)$student->grad_year != 0)echo displayed_date($student->grad_year) ; ?>"  /></p>

<p><label>Change Photo:</label><input class="file" type="file" name="student" value="" /></p>
<p><input class="submit" type="submit" name="submit" value="Update" /></p>
</fieldset>
</form>
<br class="clear" />

</div>



<?php
include_once(VIEW_PATH. 'layout/_footer.php');
?>