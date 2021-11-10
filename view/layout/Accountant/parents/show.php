<?php 
$title = 'Parent Profile';
include_once(VIEW_PATH. 'layout/_header.php');
?>

<?php include_once(VIEW_PATH. 'layout/Accountant/_nav.php'); ?>

<div id = "mainContent" style="height: 35em;">

<h3 class="title">Parent Profile</h3>

<div id="parentMsg"><?php echo flash_message($session->get_message());?></div>
<?php if(!empty($parent)):?>
<form>
<fieldset class="viewParent">
<legend>Parent Details</legend>
<input type="hidden" name="parents[id]" value="<?php echo htmlspecialchars($parent->id); ?>" />
<p><label>Full Nane:</label><input name = "parents[full_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($parent->full_name)); ?>" disabled="disabled"/></p>
<p><label>Surname:</label><input name = "parents[surname]" type="text" value="<?php echo htmlspecialchars (strtoupper($parent->surname)); ?>" disabled="disabled" /></p>
<p><label>Address:</label><textarea name ="parents[address]" cols="23" rows="4" disabled="disabled"><?php echo htmlspecialchars (strtoupper($parent->address)); ?></textarea></p>
<p><label>Email:</label><input name = "parents[email_address" type="text" value="<?php echo htmlspecialchars($parent->email_address); ?>" disabled="disabled"/></p>
<p><label>Telephone:</label><input type="text" name = "parents[telephone]" value = "<?php echo htmlspecialchars($parent->telephone); ?>" disabled="disabled" /></p>
<p><label>Mobile</label><input type="text" name = "parents[mobile]" value = "<?php echo htmlspecialchars($parent->mobile); ?>" disabled="disabled" /></p>
<p><label>Status</label><input name ="parents[status]" type="text" value="<?php echo htmlspecialchars (strtoupper($parent->status)); ?>" disabled="disabled" /></p>
<p class="edit">
<a href="<?php echo '/'. APP_ROOT.'/';?>parents/students?id=<?php echo $parent->id?>">[View Child/Children]</a>
</p>
</fieldset>
</form>

<div class="parentPhoto"><img src = "<?php echo WEBSITE.DS. APP_ROOT.DS. 'photos/parents/' . $parent->id.'.jpg';?>" alt="Parent photo" width="200px" height="170px" /></div><br class="clear" />
<?php else:?>
<div id="emptyResult"></div>
<?php endif;?>
</div>


<?php include_once(VIEW_PATH. 'layout/_footer.php');?>