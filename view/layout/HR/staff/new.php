<?php 
 
 $title = 'New Staff';
 
include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/HR/_nav.php'); ?>

<div id = "mainContent">
<h3 class="staffTitle">New Staff Profile</h3>
<div id="parentWarning"><?php echo flash_warning($session->get_message());?></div>

<form action="<?php echo '/'. APP_ROOT.'/';?>staff/new" method="post" enctype="multipart/form-data">
<fieldset class="newStaff">
<legend>Enter Staff Details</legend>
<p><label>Surname</label><input name ="staff[surname]" type="text" value=""  /></p>
<p><label>First Name</label><input name ="staff[first_name]" type="text" value="" /></p>
<p><label>Full Name</label><input name ="staff[full_name]" type="text" value="" /></p>

<p>
<label>Gender</label>
<input class="radio" name ="staff[gender]" type="radio" checked="checked" value="Male" /> Male&nbsp;&nbsp;&nbsp;&nbsp;
<input class="radio" name="staff[gender]" type="radio" value="Female" />Female
</p>
<p><label>Date of Birth</label><input name ="staff[dob]" id="date" type="text" value="" /></p>
<p>
<label>Marital Status</label>
<input class="radio" name ="staff[marital_status]" type="radio" checked="checked" value="Single" /> Single&nbsp;&nbsp;&nbsp;&nbsp;
<input class="radio" name="staff[marital_status]" type="radio" value="Married" />Married
</p>
<p><label>Address</label><input name ="staff[address]" type="text" value="" /></p>
<p><label>Nationality</label><input name ="staff[nationality]" type="text" value="" /></p>

<p><label>Email</label><input name ="staff[email_address]" type="text" value="" /></p>
<p><label>Mobile</label><input type="text" name ="staff[mobile]" value = "" /></p>
<p><label>Qualifications</label><textarea name ="staff[qualifications]" cols="23" rows="3" ></textarea></p>
<p><label>Post</label><input name ="staff[post]" type="text" value="" /></p>
<p>
<label>Status</label>
<input class="radio" name ="staff[status]" type="radio" checked="checked" value="Active" /> Active&nbsp;&nbsp;&nbsp;&nbsp;
<input class="radio" name="staff[status]" type="radio" value="Inactive" />Inactive
</p>
<p><label>Employment Date</label><input name ="staff[emp_date]" id="dat" type="text" value="" /></p>
<p><label>Upload Photo</label><input type="file" name = "staff" />
<p><input class="submit" type="submit" name="submit"  value="Submit"/></p>

</fieldset>
</form>
</div>
<?php include_once(VIEW_PATH. 'layout/_footer.php');?>




