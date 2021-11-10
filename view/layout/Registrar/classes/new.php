<?php 

$title = 'New Class';

include_once(VIEW_PATH. 'layout/_header.php'); 

?>

<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>
<div id = "mainContent" style="height: 35em;">

<h3 class="title">New Class Details</h3>

<div class="newHouseMsg"><?php echo flash_warning($session->get_message());?></div>

<form action="<?php echo '/'. APP_ROOT.'/';?>classes/new" method="post">
<fieldset class="house">
<legend>Class Details</legend>
<p><label>Title</label><input type="text" name="classes[title]" value="" /></p>
<p><label>Class Teacher</label>
<select name="classes[teacher_id]">
<option value="">Class Teacher</option>

<?php foreach($staffs as $staff):?>
<option value="<?php echo $staff->id?>"><?php echo strtoupper($staff->full_name);?></option>
<?php endforeach;?>
</select>
</p>
<p><input class="submit" type="submit" name="submit" value="Submit" /></p>

</fieldset>

</form>
</div>


<?php include_once(VIEW_PATH. 'layout/_footer.php'); ?>