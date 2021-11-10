<?php 

$title = 'Edit Class';

include_once(VIEW_PATH. 'layout/_header.php');

 ?>

<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>

<div id = "mainContent" style="height: 35em;">

<h3 class="title">Edit Class Details</h3>

<div class="newHouseMsg"><?php echo flash_warning($session->get_message());?></div>

<form action="<?php echo '/'. APP_ROOT.'/';?>classes/edit" method="post">
<fieldset class="house">
<legend>Edit Class Details</legend>

<input  type="hidden" name="classes[id]" value="<?php echo $class->id;?>" />
<p><label>Title</label><input type="text" name="classes[title]" value="<?php echo strtoupper($class->title);?>" /></p>
<p><label>Class Teacher</label>
<select name="classes[teacher_id]">
<option value="<?php echo $class->teacher_id;?>"><?php echo strtoupper($leader->full_name);?></option>
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