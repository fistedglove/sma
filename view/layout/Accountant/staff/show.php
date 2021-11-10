<?php 

$title = 'Staff Profile';

include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/Accountant/_nav.php');?>

<div id = "mainContent">
<h3 class="title">Staff Profile</h3>
<?php echo flash_message($session->get_message());?>

<form action="#" method="post">
<fieldset class="viewStaff">
<legend>Profile Details</legend>
<input type="hidden" name="staff[id]" value="<?php echo htmlspecialchars($staff->id); ?>" />
<p><label>Surname</label><input name ="staff[surname]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->surname)); ?>" disabled="disabled" /></p>
<p><label>First Name</label><input name ="staff[first_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->first_name)); ?>" disabled="disabled" /></p>
<p><label>Full Name</label><input name ="staff[full_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->full_name)); ?>" disabled="disabled" /></p>
<p><label>Date of Birth</label><input name ="staff[dob]" type="text" value="<?php echo htmlspecialchars (strtoupper(displayed_date($staff->dob))); ?>" disabled="disabled" /></p>
<p><label>Gender</label><input name ="staff[gender]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->gender)); ?>" disabled="disabled" /></p>
<p><label>Marital Status</label><input name ="staff[marital_status]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->marital_status)); ?>" disabled="disabled" /></p>
<p><label>Address</label><textarea name ="staff[address]" disabled="disabled" cols="23" rows="4" ><?php echo htmlspecialchars (strtoupper($staff->address)); ?></textarea></p>
<p><label>Nationality</label><input name ="staff[nationality]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->nationality)); ?>" disabled="disabled" /></p>
<p><label>Email</label><input name ="staff[email_address]" type="text" value="<?php echo htmlspecialchars($staff->email_address); ?>" disabled="disabled" /></p>
<p><label>Mobile</label><input type="text" name ="staff[mobile]" value ="<?php echo htmlspecialchars($staff->mobile); ?>" disabled="disabled" /></p>
<p><label>Qualifications</label><textarea name ="staff[qualifications]" disabled="disabled" cols="23" rows="3" ><?php echo htmlspecialchars (strtoupper($staff->qualifications)); ?></textarea></p>
<p><label>Post</label><input name ="staff[post]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->post)); ?>" disabled="disabled" /></p>
<p><label>Status</label><input name ="staff[status]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->status)); ?>" disabled="disabled" /></p>
<p><label>Employment Date</label><input name ="staff[emp_date]" type="text" value="<?php echo htmlspecialchars (strtoupper(displayed_date($staff->emp_date))); ?>" disabled="disabled" /></p>

<p class="edit">
<a href="<?php echo '/'. APP_ROOT.'/';?>users/edit?id=<?php echo $staff->id?>" target="_blank">[Change Password]</a>&nbsp;&nbsp;
<?php if($staff->post == 'Teacher'):?>
<a href="<?php echo '/'. APP_ROOT.'/';?>teacher_timetable/index?id=<?php echo $staff->id;?>" target="_blank" >[View Timetable]</a>&nbsp;&nbsp;
<?php endif;?>
</p>

</fieldset>
</form>
<div class="staffPhoto"><img src = "<?php echo WEBSITE.DS. APP_ROOT.DS. 'photos/staff/' . $staff->id.'.jpg';?>" alt="Staff photo" width="200px" height="150px" /></div><br class="clear" />


</div>
<?php include_once(VIEW_PATH. 'layout/_footer.php');?>