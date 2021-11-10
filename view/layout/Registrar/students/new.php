<?php 

$title = 'New Admission';

include_once(VIEW_PATH. 'layout/_header.php');

?>

<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>

<div id = "mainContent">
<h3 class="admissionTitle">Student Details</h3>
<p> Please enter the details of the student below, and click Finish.</p>

<form action = "<?php echo '/'. APP_ROOT.'/';?>students/new" method="post" enctype="multipart/form-data">
<fieldset class = "registration" > 
<legend>Personal Details</legend>

<p><label>Surname</label>
<select name="students[surname]">
<option value="<?php echo $parent->surname; ?>"><?php echo $parent->surname; ?></option>

</select>
</p>
<p><label>First Name</label><input type="text" name="students[first_name]" value="" /></p>
<p><label>Other Names</label><input type="text" name="students[other_names]" value="" /></p>
<p><label>Date of Birth</label><input type="text" name="students[dob]" id="date" value="" /></p>

<p>
<label>Gender</label>
<input class="radio" name ="students[gender]" type="radio" checked="checked" value="Male" /> Male&nbsp;&nbsp;&nbsp;&nbsp;
<input class="radio" name="students[gender]" type="radio" value="Female" />Female
</p>

<p><label>Nationality</label><input type="text" name="students[nationality]" value="" /></p>
<input type="hidden" name="students[parent_id]" value="<?php echo $parent->id; ?>" />
</fieldset>

<fieldset class = "registration" >
<legend>Academic Details</legend>
<p><label>Class</label>
<select name="students[class_id]">
<option value="All"> Select Class</option>
<?php foreach ($classes as $class): ?>
<option value="<?php echo $class->id; ?>"><?php echo htmlspecialchars(strtoupper($class->title)); ?></option>
<?php endforeach;?>
</select>
</p>
<p><label>House</label>
<select name="students[house_id]">
<option value="All"> Select Class</option>
<?php foreach ($houses as $house): ?>
<option value="<?php echo $house->id; ?>"><?php echo htmlspecialchars(strtoupper($house->house_title)); ?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Admission Date</label><input type="text" name="students[admission_date]" id="dat" value="" /></p>
<p>
<label>Status</label>
<input class="radio" name ="students[status]" type="radio" checked="checked" value="Active" /> Active&nbsp;&nbsp;&nbsp;&nbsp;
<input class="radio" name="students[status]" type="radio" value="Inactive" />Inactive
</p>
<p><label>Upload Photo</label><input class="file" type="file" name="student" value="" /></p>
<p><input class="submit" type="submit" name="submit" value="Register" /></p>
</fieldset>
</form>

</div>





<?php

include_once(VIEW_PATH. '/layout/_footer.php');

?>