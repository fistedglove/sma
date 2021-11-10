<?php 

$title = 'New Payment';
include_once(VIEW_PATH. 'layout/_header.php');

?>

<?php include_once(VIEW_PATH. 'layout/Accountant/_nav.php'); ?>

<div id = "mainContent">
<h3 class="title">Enter Student Payment</h3>

<div id="searchBox">
<form action="<?php echo '/'. APP_ROOT.'/';?>payments/new" method="post">
<fieldset>
Filter by:&nbsp;
Class 
<select name="class">
<?php if(isset($std_class)):?>
<option value=""><?php echo strtoupper($std_class->title);?></option>
<?php else:?>
<option value="">Select Class</option>
<?php endif;?>
<?php foreach($classes as $class): ?>
<option value="<?php echo $class->id;?>"><?php echo strtoupper($class->title);?></option>
<?php endforeach; ?>
</select>

<input class="image" type="image" src="<?php echo WEBSITE.DS. APP_ROOT.DS. 'images/search.png';?>" />
</fieldset> 
</form>
</div>


<div class="paymentMsg"><?php echo flash_warning($session->get_message());?></div>
<form action = "<?php echo '/'. APP_ROOT.'/';?>payments/new" method="post" enctype="multipart/form-data">
<fieldset class = "payment" > 
<legend>Payment Details</legend>

<p><label>Student Name:</label>
<select name="payments[student_id]">
<option value="">Select Student</option>
<?php foreach($students as $student): ?>
<option value="<?php echo $student->id; ?>"><?php echo htmlspecialchars(strtoupper($student->surname.  ' - '  .$student->first_name)); ?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Term</label>
<select name="payments[term]">
<option value="">Select Term</option>
<option value="First">FIRST TERM</option>
<option value="Second">SECOND TERM</option>
<option value="Third">THIRD TERM</option>
</select>
</p>
<p><label>Amount Paid(NGN)</label><input type="text" name="payments[amount_paid]"  value="" /></p>
<p><label>Amount Due(NGN)</label><input type="text" name="payments[amount_due]" value="" /></p>

<p><label>Teller/Trans No.</label><input name="payments[teller_number]" type="text" value="" /></p>

<p><label>Date</label><input type="text" name="payments[date]" id="date" value="" /></p>
<p><label>Remarks</label><textarea name="payments[remarks]"  cols="23" rows="3"></textarea></p>
<p><input class="submit" type="submit" name="submit" value="submit" /></p>
</fieldset>
</form>

</div>





<?php

include_once(VIEW_PATH. '/layout/_footer.php');

?>