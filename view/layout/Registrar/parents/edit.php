<?php 

$title = 'Edit Parent';

include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>

<div id = "mainContent">

<h3 class="studentTitle"><p>Edit Parent Details</p></h3>
<div id="studentWarning"><?php echo flash_warning($session->get_message());?></div>
<form action="<?php echo '/'. APP_ROOT.'/';?>parents/edit?id=<?php echo $parent->id; ?>" method="post" enctype="multipart/form-data">
<fieldset class="parent">
<legend>Edit Parent Details</legend>
<input type="hidden" name="parents[id]" value="<?php echo htmlspecialchars($parent->id); ?>" />
<p><label>Full Name:</label><input name = "parents[full_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($parent->full_name)); ?>" /></p>
<p><label>Surname:</label><input name = "parents[surname]" type="text" value="<?php echo htmlspecialchars (strtoupper($parent->surname)); ?>"  /></p>
<p><label>Address:</label><textarea name ="parents[address]" cols="23" rows="4" ><?php echo htmlspecialchars (strtoupper($parent->address)); ?></textarea></p>
<p><label>Email:</label><input name = "parents[email_address]" type="text" value="<?php echo htmlspecialchars($parent->email_address); ?>" /></p>
<p><label>Telephone:</label><input type="text" name = "parents[telephone]" value = "<?php echo htmlspecialchars($parent->telephone); ?>"  /></p>
<p><label>Mobile</label><input type="text" name = "parents[mobile]" value = "<?php echo htmlspecialchars($parent->mobile); ?>"  /></p>
<p>
<label>Status</label>
<?php if($parent->status == 'Active'):?>
<input class="radio" name ="parents[status]" type="radio" checked="checked" value="Active" />Active&nbsp;
<input class="radio" name="parents[status]" type="radio"  value="Inactive" />Inactive
<?php elseif($parent->status == 'Inactive'):?>
<input class="radio" name ="parents[status]" type="radio" value="Active" /> Active&nbsp;
<input class="radio" name="parents[status]" type="radio" checked="checked" value="Inactive" />Inactive
<?php endif;?>
</p>
<p><label>Change Photo:</label><input class="file" type="file" name="parent" value="" /></p>
<p><input class="submit" type="submit" name="submit" value="Update" /></p>
</fieldset>
</form>
</div>

<?php include_once(VIEW_PATH. 'layout/_footer.php');?>
