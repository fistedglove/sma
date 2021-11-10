<?php 

$title = 'Edit Staff';
include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/HR/_nav.php'); ?>

<div id = "mainContent">
<h3 class="staffTitle">Edit Staff Profile</h3>
<div id="parentWarning"><?php echo flash_warning($session->get_message());?></div>

<form action="<?php echo '/'. APP_ROOT.'/';?>staff/edit?id=<?php echo $staff->id; ?>" method="post" enctype="multipart/form-data">
<fieldset class="editStaff">
<legend>Enter Staff Details</legend>
<input type="hidden" name="staff[id]" value="<?php echo $staff->id; ?>" />
<p><label>Surname</label><input name ="staff[surname]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->surname)); ?>"  /></p>
<p><label>First Name</label><input name ="staff[first_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->first_name)); ?>"  /></p>
<p><label>Full Name</label><input name ="staff[full_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->full_name)); ?>"  /></p>

<p>
<label>Gender</label>
<?php if($staff->gender == 'Male'):?>
<input class="radio" name ="staff[gender]" type="radio" checked="checked" value="Male" /> Male&nbsp;&nbsp;&nbsp;&nbsp;
<input class="radio" name="staff[gender]" type="radio"  value="Female" />Female
<?php elseif($staff->gender == 'Female'):?>
<input class="radio" name ="staff[gender]" type="radio" value="Male" /> Male&nbsp;&nbsp;&nbsp;&nbsp;
<input class="radio" name="staff[gender]" type="radio" checked="checked" value="Female" />Female
<?php endif;?>
</p>

<p><label>Date of Birth</label><input name ="staff[dob]" id="date" type="text" value="<?php echo htmlspecialchars (strtoupper(displayed_date($staff->dob))); ?>"  /></p>
<p><label>Address</label><input name ="staff[address]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->address)); ?>"  /></p>
<p><label>Nationality</label><input name ="staff[nationality]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->nationality)); ?>"  /></p>
<p>
<label>Marital Status</label>
<?php if($staff->marital_status == 'Single'):?>
<input class="radio" name ="staff[marital_status]" type="radio" checked="checked" value="Single" /> Single&nbsp;&nbsp;
<input class="radio" name="staff[marital_status]" type="radio"  value="Married" />Married
<?php elseif($staff->marital_status == 'Married'):?>
<input class="radio" name ="staff[marital_status]" type="radio" value="Single" /> Single&nbsp;&nbsp;
<input class="radio" name="staff[marital_status]" type="radio" checked="checked" value="Married" />Married
<?php endif;?>
</p>

<p><label>Email</label><input name ="staff[email_address]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->email_address)); ?>"  /></p>
<p><label>Mobile</label><input type="text" name ="staff[mobile]" value ="<?php echo htmlspecialchars($staff->mobile); ?>"  /></p>
<p><label>Qualifications</label><textarea name ="staff[qualifications]" cols="23" rows="3" ><?php echo htmlspecialchars (strtoupper($staff->qualifications)); ?></textarea></p>
<p><label>Post</label><input name ="staff[post]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->post)); ?>"  /></p>
<p>
<label>Status</label>
<?php if($staff->status == 'Active'):?>
<input class="radio" name ="staff[status]" type="radio" checked="checked" value="Active" />Active&nbsp;
<input class="radio" name="staff[status]" type="radio"  value="Inactive" />Inactive
<?php elseif($staff->status == 'Inactive'):?>
<input class="radio" name ="staff[status]" type="radio" value="Active" /> Active&nbsp;
<input class="radio" name="staff[status]" type="radio" checked="checked" value="Inactive" />Inactive
<?php endif;?>
</p>
<p><label>Employment Date</label><input name ="staff[emp_date]" id="dat" type="text" value="<?php echo htmlspecialchars (strtoupper(displayed_date($staff->emp_date))); ?>"  /></p>
<p><label>Upload Photo</label><input type="file" name = "staff" />
<p><input class="submit" type="submit" name="submit"  value="Submit"/></p>
</fieldset>
</form>
</div>
<?php include_once(VIEW_PATH. 'layout/_footer.php');?>