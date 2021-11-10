<?php 

$title = 'New Admission';

include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>

<div id = "mainContent">
<h3 class="admissionTitle">Parent Details</h3>

<div id="admissionWarning"><?php echo flash_warning($session->get_message());?></div>
<p> Please enter the Parent's details below, and click Next</p>
<form id="parenInfo" name="parent details" action ="<?php echo '/'. APP_ROOT.'/';?>students/new" method="post" enctype="multipart/form-data">
<fieldset class = "newParent" > 
<legend>Parent Details</legend>

<p><label>Full Name:</label><input type="text" name="parents[full_name]" value="" /></p>
<p><label>Surname:</label><input type="text" name="parents[surname]" value="" /></p>
<p><label>Address:</label><input type="text" name="parents[address]" value="" /></p>
<p><label>Email:</label><input type="text" name="parents[email_address]" value="" /></p>
<p><label>Telephone:</label><input type="text" name="parents[telephone]" value="" /></p>
<p><label>Mobile:</label><input type="text" name="parents[mobile]" value="" /></p>
<p>
<label>Status</label>
<input class="radio" name ="parents[status]" type="radio" checked="checked" value="Active" /> Active&nbsp;&nbsp;&nbsp;&nbsp;
<input class="radio" name="parents[status]" type="radio" value="Inactive" />Inactive
</p>
<p><label>Upload Photo:</label><input class="file" type="file" name="parent" value="" /></p>
<p><input class="submit" type="submit" name="submit" value="Next >>>" />
</fieldset>
</form>




</div>


<?php include_once(VIEW_PATH. '/layout/_footer.php');?>